<?php
// Fonction pour authentifier l'utilisateur
function gestion_controller_auth($request){
    session_start();
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header("location:?controller=user&function=logout");
    }
    require(CONNEX_DIR);
    
    foreach($_POST as $key=>$value){
        $$key = mysqli_real_escape_string($connex, $value);
    }
    
    //1 pas : Verification de l'utilisateur
    $sql = "SELECT * FROM utilisateur WHERE nom_utilisateur = '$nom_utilisateur'";
    $result = mysqli_query($connex, $sql);
    //2 pas: Verifier si on a juste un utilisateur avec ce nom_utilisateur
    $count = mysqli_num_rows($result);
    
    if($count == 1 ){
        //3 pas: Verifier le mot de pass
        $utilisateur = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $db_mot_pass = $utilisateur['mot_pass'];
        
        // Verifier le mot de passe avec la methode, toujour premier le mot_pass envoye par la post et apres le mot_pass dans la base de donnees
        if(password_verify($mot_pass, $db_mot_pass)){
            // Creer un identifiant unique pour la session et stocker le id, le nom du utilisateur et un doe unique
            session_regenerate_id();
            $_SESSION['idUtilisateur'] = $utilisateur['idUtilisateur'];
            $_SESSION['nom_utilisateur'] = $utilisateur['nom_utilisateur'];
            $_SESSION['code_unique'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
            
            header('location:?controller=forum&function=publication');
        } else {
            header('location:?controller=user&function=login&msg=3');
        }
    } else {
        header('location:?controller=user&function=login&msg=2');
    }
}

// Fonction pour valider que le mot de passe c'est juste avec des lettres et chiffres
function gestion_validerMotPass ($mot_pass){
    $pattern = '/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/';
    return preg_match($pattern, $mot_pass);
}

// Fonction pour valider que le nom c'est juste avec des lettres
function gestion_validerNom($nom) {
    $pattern = '/^[\p{L}\s]+$/u';
    return preg_match($pattern, $nom);
}

// Fonction pour valider que le nom_utilisateur est un corriel
function gestion_validerNomUtilisateur ($nom_utilisateur){
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $nom_utilisateur);
}

// Fonction pour verifier si la personne est majeur
function gestion_validerDateNaissance ($date_naissance){
    $annee_naissance = date("Y", strtotime($date_naissance));
    $annee_actuelle = date("Y");
    
    if ($annee_actuelle - $annee_naissance > 17) {
        return $annee_actuelle - $annee_naissance;
    }
}

// Fonction pour verifier si l'utilisateur existe deja
function gestion_validerUtilisateur ($nom_utilisateur){
    require(CONNEX_DIR);
    $sql = "SELECT * FROM utilisateur WHERE nom_utilisateur = '$nom_utilisateur'";
    $result = mysqli_query($connex, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}

// Fonction pour valider si le nouveau nom_utilisateur exite deja, sans que soit de la propre personne qui est connecte
function gestion_validerUtilisateurUpdate ($idUtilisateur, $nom_utilisateur){
    require(CONNEX_DIR);
    $sql = "SELECT idUtilisateur, nom_utilisateur FROM utilisateur WHERE nom_utilisateur = '$nom_utilisateur'";
    $result = mysqli_query($connex, $sql);

    $idUtilisateurConnecte = $idUtilisateur;
    
    mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    
    if ($count == 1) {
        foreach($result as $row){
        }
        if ($idUtilisateurConnecte !== $row['idUtilisateur']) {
            return 1;
        }
        return 0;
    }

    return $count;
}

?>