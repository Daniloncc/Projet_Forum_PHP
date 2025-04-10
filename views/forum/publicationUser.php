<!-- <main class="flex__vertical flex__vertical-grand">
    <h1>Forum</h1>
    <?php foreach($data['forum'] as $row) {?>
    <article class="carte" >
        <h2><?= $row['titre']; ?> <span class="montserrat"><?= $row['date_formattee']; ?></span></h2>
        <p><?= $row['article']; ?></p>
        <small><?= $row['nom_utilisateur']; ?></small>
        <?php if($_SESSION['idUtilisateur'] == $row['forum_idUtilisateur']) {?>
            <div class="choix__bouton">
                <form action="?controller=user&function=updateForum" method="post">
                    <label for="idForum"></label>
                    <input type="hidden" id="idForum" name="idForum" value="<?= $row['idForum'];?>">
                    <input class="btn-modification" type="submit" value="Mise a jour">
                </form>
                <form action="?controller=user&function=delete" method="post">
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
</main> -->