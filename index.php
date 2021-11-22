<?php
session_start(); //* Lancement de la session

/* ------------------------ Définition des constantes ----------------------- */

/**
 * Arborescence:
 * /
 * ⎣ views
 * ⎣ controllers
 * ⎣ model
 */

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__FILE__).DS);
define("VUES", ROOT."views".DS);
define("CONTROLLERS", ROOT."controllers".DS);
/* -------------------------------------------------------------------------- */

/* ----------------------- Implementation des classes ----------------------- */
require ROOT."vendor".DS."autoload.php";

// TODO: Find a way to put this variables somewhere else
$user = 'neo4j';
$password = '123456';
$host = 'localhost';

$auth = \Laudis\Neo4j\Authentication\Authenticate::basic($user, $password);
$bdd = \Laudis\Neo4j\ClientBuilder::create()
    ->withDriver('bolt', "bolt://$user:$password@$host")
    ->withDriver('neo4j', "neo4j://$host:7687", $auth)
    ->withDriver('http', "http://$host:7474")
    ->withDefaultDriver('neo4j')
    ->build();
/* -------------------------------------------------------------------------- */

/* --------------------------------- Routeur -------------------------------- */
$connected = null;
$url = null;

if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $connected = unserialize($_SESSION['user']);
}

if(isset($_GET['url']) && !empty($_GET['url'])) {
    $url = htmlspecialchars($_GET['url']);
}

ob_start();
if($connected != null) {
    if($url === 'logout') {
        session_destroy();
        header('Location: /');
    } else {
        require CONTROLLERS."acceuil.php";
        require VUES."acceuil.php";
    }
} else if($url === 'inscription') {
    require CONTROLLERS."inscription.php";
    require VUES."inscription.php";
} else {
    require CONTROLLERS."acceuil.php";
    require VUES."acceuil.php";
}

$content = ob_get_clean();

require VUES."template".DS."base.php";
/* -------------------------------------------------------------------------- */