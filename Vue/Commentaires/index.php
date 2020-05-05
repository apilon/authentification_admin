<?php $this->titre = "Le Blogue du prof - Commentaires" ?>

<header>
    <h1 id="titreReponses">Commentaires du Blogue du prof :</h1>
</header>
<?php
foreach ($commentaires as $commentaire):
    ?>
    <?php if ($commentaire['efface'] == '0') : ?>
        <p><?= $this->nettoyer($commentaire['date']) ?>, <?= $this->nettoyer($commentaire['auteur']) ?> dit : (privé? <?= $this->nettoyer($commentaire['prive']) ?>)<br/>
            <strong><?= $this->nettoyer($commentaire['titre']) ?></strong><br/>
            <?= $this->nettoyer($commentaire['texte']) ?><br />
            <!-- Vers AdminArticles si utilisateur en session -->
            <a href="<?= ($utilisateur != '') ? 'Admin' : '' ?>Articles/lire/<?= $this->nettoyer($commentaire['article_id']) ?>" >
                [écrit pour l'article <i><?= $this->nettoyer($commentaire['titreArticle']) ?></i>]</a>
        </p>
    <?php endif; ?>
<?php endforeach; ?>