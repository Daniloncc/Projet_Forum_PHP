<?php
// Fonction pour inserer un utilisateur
function user_insert($request){
    if($_SERVER['REQUEST_METHOD'] !== "POST"){
        header('location:?controller=base'); 
    }
    
    require(CONNEX_DIR);
    require(GESTION_DIR);
    
    foreach($request as $key=>$value){
        $$key = mysqli_real_escape_string($connex, $value);
    }
    
    // Verifier que tous les champs sont remplis
    if (empty($nom) || empty($nom_utilisateur) || empty($date_naissance) || empty($mot_pass)){
        header('location:?controller=user&function=create&msg=5');
        exit();
    }

    // 0 = incompatible; 1 = compatible pour tous le validations
    $validationMotPass = gestion_validerMotpass($mot_pass);
    if ($validationMotPass == 0) {
        header('location:?controller=user&function=create&msg=6');
        exit();
    }
    
    $validationNom = gestion_validerNom($nom);
    if ($validationNom == 0) {
        header('location:?controller=user&function=create&msg=7');
        exit();
    }
    
    $validationNom = gestion_validerNomUtilisateur($nom_utilisateur);
    if ($validationNom == 0) {
        header('location:?controller=user&function=create&msg=8');
        exit();
    }
    
    $validationdateNaissance = gestion_validerDateNaissance($date_naissance);
    if ($validationdateNaissance == 0) {
        header('location:?controller=user&function=create&msg=1');
        exit();
    }
    
    // 1 ca veux dire que l'utilisateur exite, c'est donc incompatible dans ce cas ci
    $validerUtilisateur = gestion_validerUtilisateur($nom_utilisateur);
    if ($validerUtilisateur == 1) {
        header('location:?controller=user&function=create&msg=4');
        exit();
    }
    
    //Fonction qui hache un mot de passe de manière sécurisée. Utilise l'algorithme Bcrypt pour le hachage et définit le facteur de coût à 10
    $mot_pass = password_hash($mot_pass, PASSWORD_BCRYPT, ['cost' => 10]);
    
    $sql = "INSERT INTO utilisateur (nom, nom_utilisateur, date_naissance, mot_pass) VALUES ('$nom','$nom_utilisateur', '$date_naissance', '$mot_pass')";
    
    try {
        if(mysqli_query($connex, $sql)){
            header('location:?controller=user&function=login');
            exit(); 
        } 
    } catch (mysqli_sql_exception) {
        header('location:?controller=user&function=create&msg=4');
        exit();
    }
}

// Fonction pour verifier si la personne qui acesse la page est la meme qui est connecte
function user_checkSession (){
    session_start();
    if ($_SESSION['code_unique'] !== md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'])) {
        header('location:?controller=user&function=login');
        exit();
    }
}

// Fonction pour quitter la connection
function user_logout () {
    session_start();
    session_destroy();
    header('location:?controller=user&function=login');
}

// Fonction pour aller a la page de mise a jour d'Utilisateur
function user_updateUser ($request){
    require(CONNEX_DIR);
    // SECURITE: forcer le $idUtilisateur poue qui soit toujour de la persone conecte, comme ca on evite une injection par le URL
    $idUtilisateur = $_SESSION['idUtilisateur'];
    $sql = "SELECT * FROM utilisateur WHERE idUtilisateur = '$idUtilisateur'";
    $result = mysqli_query($connex, $sql);
    $count = mysqli_num_rows($result);
    
    if ($count == 1){
        $utilisateur = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $utilisateur;
    }else {
        header('location:?controller=user&function=logout');
    }
}

// Fonction pour envoyer les modifications du profil du utilisateur
function user_sendUpdateProfil($request){
    if($_SERVER['REQUEST_METHOD'] !== "POST"){
        header('location:?controller=user&function=logout');
        exit;
    }
    
    require(CONNEX_DIR);
    require(GESTION_DIR);
    $idUtilisateur = $_SESSION['idUtilisateur'];

    foreach($_POST as $key=>$value){
        $$key = mysqli_real_escape_string($connex, $value);
    }

    //Verifier que tous les champs sont remplis
    if (empty($nom) || empty($nom_utilisateur) || empty($date_naissance)){
        header('location:?controller=user&function=updateProfil&msg=5');
        exit();
    }
    
    $validationNom = gestion_validerNom($nom);
    if ($validationNom == 0) {
        header('location:?controller=user&function=updateProfil&msg=7');
        exit();
    }
    
    $validationNom = gestion_validerNomUtilisateur($nom_utilisateur);
    if ($validationNom == 0) {
        header('location:?controller=user&function=updateProfil&msg=8');
        exit();
    }
    
    $validationdateNaissance = gestion_validerDateNaissance($date_naissance);
    if ($validationdateNaissance == 0) {
        header('location:?controller=user&function=updateProfil&msg=1');
        exit();
    }
    
    $validerUtilisateurUpdate = gestion_validerUtilisateurUpdate($idUtilisateur, $nom_utilisateur);

    if ($validerUtilisateurUpdate == 1) {
        header('location:?controller=user&function=updateProfil&msg=4');
        exit();
    }
    
    $sql = "UPDATE utilisateur 
            SET nom = '$nom', 
                nom_utilisateur = '$nom_utilisateur', 
                date_naissance = '$date_naissance' 
            WHERE idUtilisateur = $idUtilisateur";
    
    try {
        if(mysqli_query($connex, $sql)){
            header('location:?controller=user&function=sucess&msg=9');
            exit(); 
        } 
    } catch (mysqli_sql_exception) {
        header('location:?controller=user&function=updateProfil&msg=4');
        exit();
    }
}

?>