<?php 

// Fonction pour envoyer a la page de creation d'un utilisateur
function user_controller_create(){
    $navigation = [
        'titrePage' => 'Creer Utilisateur',
        'nav1' => 'Forum',
        'nav2' => 'Creer votre compte',
        'nav3' => 'Connectez-vous',
        'lien1' => '?controller=forum&function=forum',
        'lien2' => '?controller=user&function=create',
        'lien3' => '?controller=user&function=login',
    ];
    //--------------------
    $vide = [];
    $vide = array('vide'=>$vide);
    $nav = array('nav'=>$navigation);
    $data = array_merge($nav, $vide);
    render("user/create.php", $data);
}

// Fonction pour envoyer a la page de connection d'un utilisateur
function user_controller_login(){
    $navigation = [
        'titrePage' => 'Connection',
        'nav1' => 'Forum',
        'nav2' => 'Creer votre compte',
        'nav3' => 'Connectez-vous',
        'lien1' => '?controller=forum&function=forum',
        'lien2' => '?controller=user&function=create',
        'lien3' => '?controller=user&function=login',
    ];
    //----------------------
    $vide = [];
    $vide = array('vide'=>$vide);
    $nav = array('nav'=>$navigation);
    $data = array_merge($nav, $vide);
    render("user/login.php", $data);
}

// Fonction pour enregistrer un nouveau utilisateur
function user_controller_store($request){
    require_once(MODEL_DIR."/user.php");
    user_insert($request);
}

// Fonction pour envoyer ver une page de reponse a l'utilisateur
function user_controller_sucess (){
    $navigation = [
        'titrePage' => 'Sucess',
        'nav1' => 'Forum',
        'nav2' => 'Profil',
        'nav3' => 'Quittez',
        'lien1' => '?controller=forum&function=publications',
        'lien2' => '?controller=user&function=updateProfil',
        'lien3' => '?controller=user&function=logout',
    ];

    require_once(MODEL_DIR."/user.php");
    user_checkSession();

    $vide = [];
    $vide = array('vide'=>$vide);
    $nav = array('nav'=>$navigation);
    $data = array_merge($nav, $vide);

    render("user/sucess.php", $data);
}

// Fonction pour quitter la connction
function user_controller_logout (){
    require_once(MODEL_DIR."/user.php");
    user_logout();
}

function user_controller_updateProfil (){
    require_once(MODEL_DIR."/user.php");
    user_checkSession();
    $navigation = [
        'titrePage' => "Mise a Jour Profil",
        'nav1' => 'Forum',
        'nav2' => 'Profil',
        'nav3' => 'Quittez',
        'lien1' => '?controller=forum&function=publications',
        'lien2' => '?controller=user&function=updateProfil',
        'lien3' => '?controller=user&function=logout',
    ];
    $user = user_updateUser($_SESSION['idUtilisateur']);
    $utilisateur = array('utilisateur'=>$user);
    $nav = array('nav'=>$navigation);
    $data = array_merge($nav, $utilisateur);

    render("user/updateProfil.php", $data);
}

function user_controller_sendUpdateProfil ($request){
    require_once(MODEL_DIR."/user.php");
    user_checkSession();
    user_sendUpdateProfil($request);
}

function user_controller_updateFail(){
    $navigation = [
        'titrePage' => 'Creer Utilisateur',
        'nav1' => 'Forum',
        'nav2' => 'Creer votre compte',
        'nav3' => 'Connectez-vous',
        'lien1' => '?controller=user&function=forum',
        'lien2' => '?controller=user&function=create',
        'lien3' => '?controller=user&function=login',
    ];
    //--------------------
    require_once(MODEL_DIR."/user.php");
    user_checkSession();
    $user = user_updateUser($_SESSION['idUtilisateur']);
    $utilisateur = array('utilisateur'=>$user);
    $nav = array('nav'=>$navigation);
    $data = array_merge($nav, $utilisateur);
    render("user/updateProfil.php", $data);
}

?>