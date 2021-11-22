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

    public function __construct(array $datas = array()) {
        $this->hydrate($datas);
    }

/* -------------------------- Accessors & Mutators -------------------------- */
    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getEmail(): string {
        return $this->email;
    }

    private function setId(int $id): void {
        if($id >= 0) {
            $this->id = $id;
        }
    }

    public function setNom(string $nom): void {
        if(!empty($nom)) {
            $this->nom = $nom;
        }
    }

    public function setPrenom(string $prenom): void {
        if(!empty($prenom)) {
            $this->prenom = $prenom;
        }
    }

    public function setEmail(string $email): void {
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