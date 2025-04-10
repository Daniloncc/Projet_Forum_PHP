<main>
    <h1>Salut, <?= $_SESSION['nom_utilisateur']?></h1>
    <h2>Modifier votre Profil</h2>
    <?= "<span class='alerte'>".$msg."</span>"; ?>
    <form class="flex__vertical" action="?controller=user&function=sendUpdateProfil" method="post">
            <label for="nom">Votre Nom</label>
            <input type="text" id="nom" name="nom" value="<?=$data['utilisateur']['nom'] ?>" >
            <label for="nom_utilisateur">Votre Utilisateur</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="<?=$data['utilisateur']['nom_utilisateur'] ?>" >
            <label for="date_naissance">Votre Date Naissance:</label>
            <input type="date" id="date_naissance" name="date_naissance" value="<?=$data['utilisateur']['date_naissance'] ?>" >
            <input class="btn" type="submit" value="Modifier">
    </form>
</main>