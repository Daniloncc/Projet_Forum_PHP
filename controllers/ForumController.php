<?php
// Function pour voir tous le publications sans etre connecte
function forum_controller_forum (){
    $navigation = [
        'titrePage' => 'Forum',
        'nav1' => 'Forum',
        'nav2' => 'Creer votre compte',
        'nav3' => 'Connectez-vous',
        'lien1' => '?controller=forum&function=forum',
        'lien2' => '?controller=user&function=create',
        'lien3' => '?controller=user&function=login',
    ];

    require_once(MODEL_DIR."/forum.php");
    $forumPosts = forum_select();
    $forum = array('forum'=>$forumPosts);
    $nav = array('nav'=>$navigation);
    $data = array_merge($nav, $forum);

    render("forum/forum.php", $data);
}

// Function pour voir tous le publications avec l'utilisateur connecte 
function forum_controller_publications (){
    $navigation = [
        'titrePage' => "Publications",
        'nav1' => 'Publier',
        'nav2' => 'Profil',
        'nav3' => 'Quittez',
        'lien1' => '?controller=forum&function=publication',
        'lien2' => '?controller=user&function=updateProfil',
        'lien3' => '?controller=user&function=logout',
    ];

    require_once(MODEL_DIR."/user.php");
    user_checkSession();
    require_once(MODEL_DIR."/forum.php");
    $forumPosts = forum_select();
    $forum = array('forum'=>$forumPosts);
    $nav = array('nav'=>$navigation);
    $data = array_merge($nav, $forum);

    render("forum/forum.php", $data);
}

// Function pour creer des publications
function forum_controller_publication (){
    $navigation = [
        'titrePage' => 'Publier',
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

    render("forum/publication.php", $data);
}

// Function pour inserer une publication
function forum_controller_insertForum (){
    require_once(MODEL_DIR."/user.php");
    user_checkSession();
    require_once(MODEL_DIR."/forum.php");
    forum_insert($_REQUEST);
}

// Fonction pour aller a la page de update publication et retourner la publication souhaite 
function forum_controller_updatePublication (){
    $navigation = [
        'titrePage' => "Mise a jour Publication",
        'nav1' => 'Forum',
        'nav2' => 'Profil',
        'nav3' => 'Quittez',
        'lien1' => '?controller=user&function=connection',
        'lien2' => '?controller=user&function=updateProfil',
        'lien3' => '?controller=user&function=logout',
    ];

    require_once(MODEL_DIR."/user.php");
    user_checkSession();
    require_once(MODEL_DIR."/forum.php");
    $forum_db = forum_updatePub($_REQUEST);
    $forum = array('forum'=>$forum_db);
    $nav = array('nav'=>$navigation);
    $data = array_merge($nav, $forum);
    render("forum/updatePublication.php", $data);
}

// Fonction pour envoyer la publication a jour
function forum_controller_sendUpdateForum (){
    require_once(MODEL_DIR."/user.php");
    user_checkSession();
    require_once(MODEL_DIR."/forum.php");
    forum_sendUpdateForum($_REQUEST);
    //render("user/updatePublication.php", $data);
}

// Fonction pour confirmer pour supprimer une publication
function forum_controller_askdelete (){
    require_once(MODEL_DIR."/user.php");
    user_checkSession();
    require_once(MODEL_DIR."/forum.php");
    forum_askdelete($_REQUEST);
    //render("user/updatePublication.php", $data);
}

// Function pour supprimer la publication
function forum_controller_delete (){
    require_once(MODEL_DIR."/user.php");
    user_checkSession();
    require_once(MODEL_DIR."/forum.php");
    forum_delete($_REQUEST);
    //render("user/updatePublication.php", $data);
}

?>