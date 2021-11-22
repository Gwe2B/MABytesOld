<?php

namespace MABytes;

/**
 * User representation from database
 * @author Hugo Ragiot, Gwenaël Guiraud
 * @version 2
 */
class User {
    use Hydrator;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;
    private $prenom;
    private $email;

    public function __construct(array $datas) {
        $this->hydrate($datas);
    }

/* -------------------------------- Accessors ------------------------------- */
    private function setId(int $id) {
        if($id >= 0) {
            $this->id = $id;
        }
    }

    public function setNom(string $nom) {
        if(!empty($nom)) {
            $this->nom = $nom;
        }
    }

    public function setPrenom(string $prenom) {
        if(!empty($prenom)) {
            $this->prenom = $prenom;
        }
    }

    public function setEmail(string $email) {
        if(!empty($email)) {
            $this->email = $email;
        }
    }

/* ---------------------- Serialization Implementation ---------------------- */
    public function __serialize(): array {
        return array(
            'id'     => $this->id,
            'nom'    => $this->nom,
            'prenom' => $this->prenom,
            'email'  => $this->email
        );
    }

    public function __unserialize(array $data): void {
        $this->hydrate($data);
    }
}