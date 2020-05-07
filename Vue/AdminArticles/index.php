<?php $this->titre = 'Le Blogue du prof'; ?>

<a href="Adminarticles/ajouter">
    <h2 class="titreArticle">Ajouter un article</h2>
</a>
<?php foreach ($articles as $article):
    ?>

    <article>
        <header>
            <a href="Adminarticles/lire/<?= $this->nettoyer($article['id']) ?>">
                <h1 class="titreArticle"><?= $this->nettoyer($article['titre']) ?></h1>
            </a>
            <strong class=""><?= $this->nettoyer($article['sous_titre']) ?></strong>
            <time><?= $this->nettoyer($article['date']) ?></time>, par <?= $this->nettoyer($article['nom']) ?>
        </header>
        <p><?= $this->nettoyer($article['texte']) ?><br/>
            <em><?= $this->nettoyer($article['type']) ?></em>
            <a href="Adminarticles/modifier/<?= $this->nettoyer($article['id']) ?>"> [modifier l'article]</a>
        </p>
    </article>
    <hr />
<?php endforeach; ?>    
