<?php

namespace MABytes;

use \Laudis\Neo4j\ClientBuilder;
use \Laudis\Neo4j\Authentication\Authenticate;
use Laudis\Neo4j\Databags\Statement;

//require_once dirname(__FILE__).'/vendor/autoload.php';

/**
 * Class Description
 * @author Hugo Ragiot, Updated By: Gwenaël Guiraud
 * @version 2
 */
class UserManager {
    private static $instance = null;

    /**
     * @var \Laudis\Neo4j\Client
     */
    private $bdd;

    private function __construct(\Laudis\Neo4j\Client $bdd) {
        $this->bdd = $bdd;
    }

    /**
     * Instance getter (Singleton)
     * @return UserManager
     */
    public static function getInstance(\Laudis\Neo4j\Client $bdd): UserManager {
        if(self::$instance == null) {
            self::$instance = new UserManager($bdd);
        }

        return self::$instance;
    }

    //TODO: Add the password verification
    /**
     * Get a user by mail and check his password
     * @param string $email The user's email
     * @param string $password The user's password
     * @return null|User Return null if there is no match in the DB, otherwise
     *  return the corresponding User object 
     */
    public function getUserByMail(string $email, string $password): ?User {
        $queryResults = $this->bdd->getClient()->runStatements([
            Statement::create(
                'MATCH (u:Person)
                WHERE
                    u.email=$email AND
                    u.password=$password
                RETURN u',
                array(
                    'email'    => $email,
                    'password' => $password
                )
            )
        ]);

        $result = array();

        foreach($queryResults as $row) {
            $node = $row->get(0)->get('u');
            $result['id'] = intval($node->getId());
            
            foreach($node->properties() as $ppt => $value) {
                $result[$ppt] = $value;
            }
        }

        if(!empty($result)) {
            $result = new User($result);
        } else {
            $result = null;
        }

        return $result;
    }
}