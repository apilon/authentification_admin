<?php $this->titre = 'Le Blogue du prof'; ?>

<?php foreach ($articles as $article):
    ?>
    <article>
        <header>
            <a href="Articles/lire/<?= $this->nettoyer($article['id']) ?>">
                <h1 class="titreArticle"><?= $this->nettoyer($article['titre']) ?></h1>
            </a>
            <strong class=""><?= $this->nettoyer($article['sous_titre']) ?></strong>
            <time><?= $this->nettoyer($article['date']) ?></time>, par utilisateur #<?= $this->nettoyer($article['utilisateur_id']) ?>
        </header>
        <p><?= $this->nettoyer($article['texte']) ?><br/>
            <em><?= $this->nettoyer($article['type']) ?></em>
        </p>
    </article>
    <hr />
<?php endforeach; ?>    
