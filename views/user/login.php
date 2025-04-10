<main>
    <h1>Connectez-vous</h1>
    <form class="flex__vertical" action="?controller=gestion&function=auth" method="post">
            <label for="nom_utilisateur">Utilisateur</label>
            <input type="email" id="nom_utilisateur" name="nom_utilisateur" placeholder="Curriel" required >
            <label for="mot_pass">Mot de passe:</label>
            <input type="password" id="mot_pass" name="mot_pass" placeholder="Mot de pass" required>
            <?= "<span class='alerte'>".$msg."</span>"; ?>
            <input class="btn btn-noir" type="submit" value="Envoyer">
            <a href="?controller=user&function=create">Creer votre compte</a>
    </form>
</main>