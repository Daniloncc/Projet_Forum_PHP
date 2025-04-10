<?php
require_once('config/config.php');
require_once('lib/core.php');


// Spécifie quel contrôleur utiliser (par exemple, "home", "user").
$controller = isset($_REQUEST['controller'])?safe($_REQUEST['controller']):$config['default_controller'];
//Spécifie quelle méthode du contrôleur appeler (par exemple, "index", "view")
$function = isset($_REQUEST['function'])?safe($_REQUEST['function']):$config['default_function'];

//construit le chemin du fichier du contrôleur, majuscule la première lettre(ucfirst($controller)), 
$controller_file = "controllers/".ucfirst($controller)."Controller.php";
//print($controller_file);

if(!file_exists($controller_file)){
    trigger_error('Could not find this file');
    exit();
}
require_once($controller_file);

$controller_function = strtolower($controller)."_controller_".$function;
 //print($controller_function);
// print_r($_REQUEST);
//Vérifie si la fonction correspondant au contrôleur et à la fonction existe
if(!function_exists($controller_function )){
    trigger_error('Could not find this function');
    exit();
}
//C'est la fonction PHP native qui prend un premier argument représentant la fonction à appeler et les arguments suivants qui seront passés à cette fonction.
//Contient généralement les entrées utilisateur provenant de l'URL ou des formulaires
call_user_func($controller_function, $_REQUEST);
?>