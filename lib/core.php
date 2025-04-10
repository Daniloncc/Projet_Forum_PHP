<?php
//La fonction Safe est utile lors de la gestion de l'entrée de l'utilisateur pour protéger contre l'injection SQL
function safe($param){
    //Ajoute une barre oblique inverse devant chaque guillemet double (")
    return addslashes($param);
}

//Cette fonction est responsable de l'affichage d'une vue et de son intégration dans une mise en page.
function render($file, $data = null, $msg = null){
    $layout_file = VIEW_DIR."/layouts/layout.php";

    if (isset($_GET['msg']) && ($_GET['msg']) == 1) {
        $msg = "Vous devez avoir plus de 18 ans !";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 2) {
        $msg = "Utilisateur incorrect!";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 3) {
        $msg = "Mot de pass incorrect!";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 4) {
        $msg = "Cet utilisateur existe déjà !";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 5) {
        $msg = "Tous les champs doivent être remplis ! ";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 6) {
        $msg = "Votre mot de passe doit contenir des lettres et des chiffres !";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 7) {
        $msg = "Votre nom ne peut contenir que des lettres !";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 8) {
        $msg = "Ecrivez un curriel valide!";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 9) {
        $msg = "Votre profil a été modifié !";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 10) {
        $msg = "Votre publication a été mise à jour ! ";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 12) {
        $msg = "Êtes-vous sûr de supprimer cette publication ? ";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 13) {
        $msg = "Votre publication a été supprimée ! ";
    } elseif (isset($_GET['msg']) && ($_GET['msg']) == 14) {
        $msg = "Votre publication a été publiée ! ";
    }

    if (is_array($data)) {
        extract($data); // Extrait les clés du tableau $data en tant que variables
    }
    //Cette fonction empêche le contenu d'être immédiatement envoyé au navigateur. Démarrer la mise en mémoire tampon de sortie. Cela signifie que tout contenu généré (comme Echo ou Print) ne sera pas envoyé immédiatement au navigateur. Au lieu de cela, il est stocké dans un tampon. 
    ob_start();
    //Le contenu de ce fichier est stocké dans la mémoire tampon de la sortie.
    include_once(VIEW_DIR."/".$file);
    //Cette fonction récupère le contenu de la mémoire tampon et efface ensuite le tampon.
    $content = ob_get_clean();
    
    //Après avoir capturé le contenu de la vue, le fichier de mise en page est inclus, qui contient généralement la structure HTML de la page (en-tête, pied de page, etc.). Les vues sont rendues dynamiquement avec des modèles de mise en page qui enveloppent le contenu
    include_once($layout_file);


    //ob_end_clean () : Termine la tampon de sortie et élimine le contenu. Ceci est généralement utilisé lorsque vous n'avez plus besoin du contenu tamponné. 
}



