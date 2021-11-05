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
$url = null;

if(isset($_GET['url']) && !empty($_GET['url'])) {
    $url = htmlspecialchars($_GET['url']);
}

ob_start();
if($url === 'page') {
    // TODO: Update with correct values
    require CONTROLLERS."page.php";
    require VUES."page.php";
} else {
    require CONTROLLERS."acceuil.php";
    require VUES."acceuil.php";
}

$content = ob_get_clean();

require VUES."template".DS."base.php";
/* -------------------------------------------------------------------------- */