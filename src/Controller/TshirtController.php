<?php

namespace App\Controller;

use App\Entity\Tshirt;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TshirtController extends AbstractController
{
    public $tshirts;

    public function __construct()
    {
        $this->tshirts = [
            new Tshirt("bidule", 15,"blanc", 1),
            new Tshirt("truc", 36, "noir", 2),
            new Tshirt("machin", 25,"rose", 3),
        ];
    }



    /**
     * @Route("/tshirt", name="tshirt")
     */
    public function index(): Response
    {
            return $this->render('tshirt/index.html.twig', [
            'controller_name' => 'TshirtController',
            "tshirts" => $this->tshirts
        ]);
    }

    /**
     * @Route("/tshirt/{id}", name="tshirtId")
     */
    
    public function getOneTshirt($id): Response
    {
          
    

        $result = current(array_filter($this->tshirts, function($tshirt) use ($id)
        {
           
            return $tshirt->id == $id;
        }));
        
    
        // dd($result);
        return $this->render('tshirt/article.html.twig', [
            'controller_name' => 'TshirtController',
            'tshirt'=>$result

            
        ]);
    }
}
