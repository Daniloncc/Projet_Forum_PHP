<main>
    <h1>Creer un Utilisateur</h1>
    <?= "<span class='alerte'>".$msg."</span>"; ?>
    <form class="flex__vertical" action="?controller=user&function=store" method="post">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" minlength="2" maxlength="25" placeholder="Votre nom" required >
            <label for="nom_utilisateur">Utilisateur</label>
            <input type="email" id="nom_utilisateur" name="nom_utilisateur"  maxlength="60" placeholder="Ecrivez votre courriel" required>
            <label for="date_naissance">Date Naissance:</label>
            <input type="date" id="date_naissance" name="date_naissance" placeholder="Utilisateur" required>
            <label for="mot_pass">Mot de passe:</label>
            <input type="password" id="mot_pass" name="mot_pass" minlength="6" maxlength="20" placeholder="Mot passe entre 6 et 20 caractères" required>
            <input class="btn" type="submit" value="Envoyer">
    </form>
</main>