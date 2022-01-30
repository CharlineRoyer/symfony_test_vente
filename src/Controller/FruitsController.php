<?php

namespace App\Controller;

use App\Entity\Fruit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class FruitsController extends AbstractController
{
    /**
     * @Route("/fruits", name="fruits")
     */
    public function index(): Response
    {
        // new Fruit('fraise', 'rouge');
        $fruits = ["fraise","pomme","cassis"];

        $fruits = [
            new Fruit("Pomme","vert"),
            new Fruit("Fraise","rouge"),
            new Fruit("Framboise","rose"),
            new Fruit("Cerise","rouge"),
            new Fruit("Banane","jaune"),

        ];
       
        

        return $this->render('fruits/index.html.twig', [
            'controller_name' => 'FruitsController',
            'fruits'=> $fruits,
        ]);
    }
}
