<main class="flex__vertical flex__vertical-grand">
<h1>Salut, <?= $_SESSION['nom_utilisateur']?></h1>
    <?php foreach($data['forum'] as $row) {?>
    <article class="carte" >
        <h2><?= $row['titre']; ?> <span class="montserrat"><?= $row['date_formattee']; ?></span></h2>
        <p><?= $row['article']; ?></p>
        <small><?= $row['nom_utilisateur']; ?></small>
        <?php if(isset($_SESSION['idUtilisateur']) && $_SESSION['idUtilisateur'] == $row['forum_idUtilisateur']) {?>
            <div class="choix__bouton">
                <form action="?controller=forum&function=updatePublication" method="post">
                    <label for="idForum"></label>
                    <input type="hidden" id="idForum" name="idForum" value="<?= $row['idForum'];?>">
                    <input class="btn-modification" type="submit" value="Mise a jour">
                </form>
                <form action="?controller=forum&function=askdelete" method="post">
                <label for="idForum"></label>
                <input type="hidden" id="idForum" name="idForum" value="<?= $row['idForum'];?>">
                    <input class="btn-modification btn-modification-rouge" type="submit" value="Supprimer">
                </form>
            </div>
        <?php }?>
    </article class="montserrat">
    <?php
    }
    ?>
</main>