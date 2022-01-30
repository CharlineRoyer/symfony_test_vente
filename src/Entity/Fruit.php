<?php

namespace App\Entity;

class Fruit{
    public $nom;
    public $couleur;

    public function __construct($nom, $couleur){
        $this->nom = $nom;
        $this->couleur = $couleur;
    }

}