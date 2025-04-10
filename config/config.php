<?php
//Creation des variables globales
define('MODEL_DIR', 'models');
define('VIEW_DIR', 'views');
define('CONNEX_DIR', 'lib/connex.php');
define('GESTION_DIR', 'controllers/GestionController.php');


$config = array (
    //Spécifie le contrôleur par défaut qui sera utilisé lorsqu’aucun contrôleur spécifique n’est demandé.
    'default_controller' => 'base',
    //Spécifie la fonction (ou méthode) par défaut à exécuter dans ce contrôleur. Généralement, index() est le point d’entrée principal
    'default_function' => 'index',
);