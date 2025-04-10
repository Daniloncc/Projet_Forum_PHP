<main>
    <h1>Salut, <?= $_SESSION['nom_utilisateur']?></h1>
     <h2>Modifier votre Publication</h2>
    <article class="carte" >
    <form class="flex__vertical" action="?controller=forum&function=sendUpdateForum" method="post">
            <label for="titre">Titre</label>
            <input type="hidden" name="idForum" value="<?= $forum['idForum'];?>">
            <input type="text" id="titre" name="titre" minlength="5" maxlength="100"  value="<?=$forum['titre'] ?>">
            <label for="article">Article</label>
            <textarea class="boite" name="article" id="article" minlength="2" maxlength="1000"><?=$forum['article'] ?></textarea>
            <input class="btn btn-noir" type="submit" value="Modifier">
    </form>
    </article class="montserrat">
</main>