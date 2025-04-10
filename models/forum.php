<?php
// Fonction pour afficher tous le publications
function forum_select(){
    require(CONNEX_DIR);

    $sql = "SELECT forum.*, utilisateur.nom_utilisateur, 
    DATE_FORMAT(forum.date_publication, '%Y-%m-%d %H:%i') AS date_formattee
    FROM forum 
    INNER JOIN utilisateur ON forum.forum_idUtilisateur = utilisateur.idUtilisateur 
    ORDER BY forum.date_publication DESC";

    $result = mysqli_query($connex, $sql);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $result;
}

//Function pour inserer une publication
function forum_insert(){
    require(CONNEX_DIR);

    if($_SERVER['REQUEST_METHOD'] !== "POST"){

    }
    $forum_idUtilisateur = ($_SESSION['idUtilisateur']);

    foreach($_POST as $key=>$value){
        $$key = mysqli_real_escape_string($connex, $value);
    }
    
     $sql = "INSERT INTO forum(titre, article, date_publication, forum_idUtilisateur)
     VALUES('$titre', '$article', NOW(), $forum_idUtilisateur);";
    
        if (mysqli_query($connex, $sql)){
            header('location:?controller=user&function=sucess&msg=14');
        }else{
            header('location:?controller=user&function=logout'); 
            exit;
        } 
}

//Function retourner la publication qu'on souhaite modifier
function forum_updatePub($request){
    if($_SERVER['REQUEST_METHOD'] !== "POST"){
        header('location:?controller=user&function=logout'); 
        exit;
    }
    $idUtilisateurConnecte = $_SESSION['idUtilisateur'];
    $idForum = $_POST;
    require(CONNEX_DIR);

    foreach($_POST as $key=>$value){
           $$key = mysqli_real_escape_string($connex, $value); 
        }

    $sql = "SELECT * FROM forum WHERE idForum = '$idForum'";
    $result = mysqli_query($connex, $sql);
    $forum = mysqli_fetch_array($result, MYSQLI_ASSOC);

    //Securizer que la personne connecte est la meme de la persone qui a fait la publication
    if ($idUtilisateurConnecte == $forum['forum_idUtilisateur']) {
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            return $forum;
        } else {
            header('location:?controller=user&function=logout');
            exit;
        }
    }

}

// Fonction pour envoyer la publication a jour
function forum_sendUpdateForum ($request){
    if($_SERVER['REQUEST_METHOD'] !== "POST"){
        header('location:?controller=user&function=logout'); 
        exit;
    }
    $idUtilisateurConnecte = $_SESSION['idUtilisateur'];
    require(CONNEX_DIR);

    foreach($_POST as $key=>$value){
           $$key = mysqli_real_escape_string($connex, $value); 
        }

    $forum_idUtilisateur = forum_verifierUser($idForum);

    $sql = "UPDATE forum
            SET titre = '$titre', 
            article = '$article',
            date_publication = NOW()  
            WHERE idForum = $idForum";

    if ($idUtilisateurConnecte == $forum_idUtilisateur) {
        if (mysqli_query($connex, $sql)) {
        header('location:?controller=user&function=sucess&msg=10');
        } else {
            header('location:?controller=user&function=logout'); 
            exit;
        }
    }
}

// Function pour verifier le id de la personne qui veut le mise a jour de la publication
function forum_verifierUser($idForum) {
    require(CONNEX_DIR);

    foreach($_POST as $key=>$value){
           $$key = mysqli_real_escape_string($connex, $value); 
        }
    $sql = "SELECT * FROM forum WHERE idForum = '$idForum'";
    $result = mysqli_query($connex, $sql);
    $forum = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $forum_idUtilisateur = $forum['forum_idUtilisateur'];
    return $forum_idUtilisateur;

}

// Function pour supprimer une publication
function forum_askdelete ($request) {
    if($_SERVER['REQUEST_METHOD'] !== "POST"){
        header('location:?controller=user&function=logout'); 
        exit;
    }
    require(CONNEX_DIR);
    foreach($_POST as $key => $value){
        $$key = mysqli_real_escape_string($connex, $value);
    }
    session_regenerate_id();
    $_SESSION['idForum'] = $idForum;
    $idUtilisateurConnecte = $_SESSION['idUtilisateur'];
    $forum_idUtilisateur = forum_verifierUser($idForum);

    print($_SESSION['idForum']);
    $sql = "DELETE FROM forum WHERE idForum = $idForum";

    if ($forum_idUtilisateur == $idUtilisateurConnecte) {
            header("location:?controller=forum&function=publications&msg=12");
    } else {
        header('location:?controller=user&function=logout'); 
        exit;
    }
 

}

// Function pour supprimer la publication
function forum_delete ($request) {
    if($_SERVER['REQUEST_METHOD'] !== "POST"){
        header('location:?controller=user&function=logout'); 
        exit;
    }
    require(CONNEX_DIR);
    foreach($_POST as $key => $value){
        $$key = mysqli_real_escape_string($connex, $value);
    }
    
    $idUtilisateurConnecte = $_SESSION['idUtilisateur'];
    $forum_idUtilisateur = forum_verifierUser($idForum);

    $sql = "DELETE FROM forum WHERE idForum = $idForum";

    if ($forum_idUtilisateur == $idUtilisateurConnecte) {
        if(mysqli_query($connex,  $sql)){
            header("location:?controller=user&function=sucess&msg=13");
        }
        else {
            header('location:?controller=user&function=logout'); 
        exit;
        }
    }

}
?>




