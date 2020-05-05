<?php

require_once 'Framework/Modele.php';

/**
 * Fournit les services d'accès aux genres musicaux 
 * 
 * @author Baptiste Pesquet
 */
class Commentaire extends Modele {

    // Renvoie la liste des commentaires associés à un article
    public function getCommentaires($idArticle = NULL) {
        if ($idArticle == NULL) {
            $sql = 'select c.id, article_id, c.date, auteur, c.titre, c.texte, prive, efface, a.titre as titreArticle from commentaires as c, articles as a'
                    . ' where c.article_id = a.id';
        } else {
            $sql = 'select * from commentaires'
                    . ' where article_id = ?';
        }
        $commentaires = $this->executerRequete($sql, [$idArticle]);
        return $commentaires;
    }

// Renvoie un commentaire spécifique
    public function getCommentaire($id) {
        $sql = 'select * from commentaires'
                . ' where id = ?';
        $commentaire = $this->executerRequete($sql, [$id]);
        if ($commentaire->rowCount() == 1) {
            return $commentaire->fetch();  // Accès à la première ligne de résultat
        } else {
            throw new Exception("Aucun commentaire ne correspond à l'identifiant '$id'");
        }
    }

// Supprime un commentaire
    public function deleteCommentaire($id) {
        $sql = 'UPDATE commentaires'
                . ' SET efface = 1'
                . ' WHERE id = ?';
        $result = $this->executerRequete($sql, [$id]);
        return $result;
    }

    // Réactive un commentaire
    public function restoreCommentaire($id) {
        $sql = 'UPDATE commentaires'
                . ' SET efface = 0'
                . ' WHERE id = ?';
        $result = $this->executerRequete($sql, [$id]);
        return $result;
    }

// Ajoute un commentaire associés à un article
    public function setCommentaire($commentaire) {
        $sql = 'INSERT INTO commentaires (article_id, date, auteur, titre, texte, prive) VALUES(?, NOW(), ?, ?, ?, ?)';
        $result = $this->executerRequete($sql, [$commentaire['article_id'], $commentaire['auteur'], $commentaire['titre'], $commentaire['texte'], $commentaire['prive']]);
        return $result;
    }

}
