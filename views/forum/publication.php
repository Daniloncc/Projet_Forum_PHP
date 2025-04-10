<main>
    <h1>Creer une Publication</h1>
    <h2>Salut, <?= $_SESSION['nom_utilisateur']?></h2>
    <article class="carte" >
    <form class="flex__vertical" action="?controller=forum&function=insertForum" method="post">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" minlength="5" maxlength="100" placeholder="Creer un titre entre 5 et 100 caractères" >
            <label for="article">Article</label>
            <textarea class="boite" name="article" id="article" minlength="2" maxlength="1000" placeholder="Redigez votre article avec un maximum de 1000 caractères"></textarea>
            <input class="btn btn-noir" type="submit" value="Publier">
    </form>
    </article class="montserrat">
</main>
