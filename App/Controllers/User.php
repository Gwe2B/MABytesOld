<?php

namespace App\Controllers;

    use \Laudis\Neo4j\ClientBuilder;
    use \Laudis\Neo4j\Authentication\Authenticate;
    use Laudis\Neo4j\Databags\Statement;
    use App\Controllers\Database;

    require_once dirname(__FILE__).'/vendor/autoload.php';

//Optionnel le extends pour le moment
class User extends Database {


    public function getUserByMail(String $email, String $password) {

         //Test
         $name = 'Jean-Michel De la Creuse';
         $surname = 'Pierre';
         $email = 'Pierre.paul@jack.com';

        $auth = Authenticate::basic('neo4j', '1234');
    
        $client = ClientBuilder::create()
        ->withDriver('bolt', 'bolt://neo4j:123456@localhost')
        ->withDriver('neo4j', 'neo4j://localhost:7687', $auth)
        ->withDriver('http', 'http://localhost:7474')
        ->withDefaultDriver('neo4j')
        ->build();

        $results = $client->runStatements([
            Statement::create('MATCH u:Person  
                               WHERE u.email= $email 
                               AND 
                               u.password = $password 
                               RETURN u')
        ]);

        echo $results;
    }
}



?>