<?php 
function base_controller_index(){

    $navigation = [
        'titrePage' => 'Bien Venue',
        'nav1' => 'Forum',
        'nav2' => 'Creer votre compte',
        'nav3' => 'Connectez-vous',
        'lien1' => '?controller=user&function=forum',
        'lien2' => '?controller=user&function=create',
        'lien3' => '?controller=user&function=login',
    ];

    $vide = [];
    $vide = array('vide'=>$vide);
    $nav = array('nav'=>$navigation);
    $data = array_merge($nav, $vide);

    render("welcome.php", $data);
}
?>