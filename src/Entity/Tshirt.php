<?php

namespace App\Entity;

class Tshirt{
    public $nom;
    public $prix;
    public $couleur;
    public $id;

    public function __construct($nom, $prix, $couleur, $id){
        $this->nom = $nom;
        $this->prix = $prix;
        $this->couleur = $couleur;
        $this->id = $id;
    }

}