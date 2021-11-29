<?php

namespace MABytes; 

require_once dirname(__FILE__).'/vendor/autoload.php';
require_once("src/Decrypt.php");

    use \Laudis\Neo4j\ClientBuilder;
    use \Laudis\Neo4j\Authentication\Authenticate;
    use Laudis\Neo4j\Databags\Statement;
   
    $login = "";
    $password = "";
    decryptDatabase($login, $password);

    $auth = Authenticate::basic($login, $password);
    
    $client = ClientBuilder::create()
        ->withDriver('bolt', 'bolt://neo4j:123456@localhost')
        ->withDriver('neo4j', 'neo4j://localhost:7687', $auth)
        ->withDriver('http', 'http://localhost:7474')
        ->withDefaultDriver('neo4j')
        ->build();

  /*  $results = $client->runStatements([
        Statement::create("
            MATCH (p:People)
            RETURN p
        ")
    ]);

  foreach($results as $r) {
        $node = $r->get(0);
        var_dump($node->get(0)->get('properties'));
    } 

  $query = 'CREATE (user:Person 
                {name: $name,
                 surname: $surname,
                 email: $email,
                 password: $password})
          RETURN user'; */

//$Statements = new Statement('CREATE (user:Person {name: $name})', ['name' => $name]);
//$client->runStatement($Statements);

$Statement = Statement::create('MATCH (user:Person) RETURN user.name');
//echo '<h1>'. $Statement .'</h1>';
var_dump($Statement);
?>
