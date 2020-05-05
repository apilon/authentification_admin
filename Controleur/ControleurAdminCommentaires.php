<?php

require_once 'Controleur/ControleurAdmin.php';
require_once 'Modele/Commentaire.php';

class ControleurAdminCommentaires extends ControleurAdmin {

    private $commentaire;

    public function __construct() {
        $this->commentaire = new Commentaire();
    }

// L'action index n'est pas utilisée mais pourrait ressembler à ceci 
// en ajoutant la fonctionnalité de faire afficher tous les commentaires
    public function index() {
        $commentaires = $this->commentaire->getCommentaires();
        $this->genererVue(['commentaires' => $commentaires]);
    }

// Ajoute un commentaire à un article
    public function ajouter() {
        $commentaire['article_id'] = $this->requete->getParametreId("article_id");
        $commentaire['auteur'] = $this->requete->getParametre('auteur');
        $validation_courriel = filter_var($commentaire['auteur'], FILTER_VALIDATE_EMAIL);
        if ($validation_courriel) {
            $commentaire['titre'] = $this->requete->getParametre('titre');
            $commentaire['texte'] = $this->requete->getParametre('texte');
            $commentaire['prive'] = $this->requete->getParametre('prive');
            // Ajouter le commentaire à l'aide du modèle
            $this->commentaire->setCommentaire($commentaire);
            // Éliminer un code d'erreur éventuel
            if ($this->requete->getSession()->existeAttribut('erreur')) {
                $this->requete->getsession()->setAttribut('erreur', '');
            }
            //Recharger la page pour mettre à jour la liste des commentaires associés
            $this->rediriger('AdminArticles', 'lire/' . $commentaire['article_id']);
        } else {
            //Recharger la page avec une erreur près du courriel
            $this->requete->getSession()->setAttribut('erreur', 'courriel');
            $this->rediriger('AdminArticles', 'lire/' . $commentaire['article_id']);
        }
    }

// Confirmer la suppression d'un commentaire
    public function confirmer() {
        $id = $this->requete->getParametreId("id");
        // Lire le commentaire à l'aide du modèle
        $commentaire = $this->commentaire->getCommentaire($id);
        $this->genererVue(['commentaire' => $commentaire]);
    }

// Supprimer un commentaire
    public function supprimer() {
        $id = $this->requete->getParametreId("id");
        // Lire le commentaire afin d'obtenir le id de l'article associé
        $commentaire = $this->commentaire->getCommentaire($id);
        // Supprimer le commentaire à l'aide du modèle
        $this->commentaire->deleteCommentaire($id);
        //Recharger la page pour mettre à jour la liste des commentaires associés
        $this->rediriger('AdminArticles', 'lire/' . $commentaire['article_id']);
    }

    // Rétablir un commentaire
    public function retablir() {
        $id = $this->requete->getParametreId("id");
        // Lire le commentaire afin d'obtenir le id de l'article associé
        $commentaire = $this->commentaire->getCommentaire($id);
        // Supprimer le commentaire à l'aide du modèle
        $this->commentaire->restoreCommentaire($id);
        //Recharger la page pour mettre à jour la liste des commentaires associés
        $this->rediriger('AdminArticles', 'lire/' . $commentaire['article_id']);
    }
}
