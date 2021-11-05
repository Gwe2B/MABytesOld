<?php

namespace App\Controllers;

require_once dirname(__FILE__).'/vendor/autoload.php';

use \Laudis\Neo4j\ClientBuilder;
use \Laudis\Neo4j\Authentication\Authenticate;
use Laudis\Neo4j\Databags\Statement;

class Database {

    function __construct() {

     $auth = Authenticate::basic('neo4j', '1234');
    
    $client = ClientBuilder::create()
        ->withDriver('bolt', 'bolt://neo4j:123456@localhost')
        ->withDriver('neo4j', 'neo4j://localhost:7687', $auth)
        ->withDriver('http', 'http://localhost:7474')
        ->withDefaultDriver('neo4j')
        ->build();
    }
}