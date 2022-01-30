<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NWSController extends AbstractController
{
    /**
     * @Route("owo", name="nws")
     */
    public function index(): Response
    {

        $image = "https://img.passeportsante.net/1000x526/2021-05-06/i106626-signes-bonne-sante-du-chat.jpg";

        return $this->render('nws/index.html.twig', [
            'controller_name' => 'NWSController',
            'image' => $image
        ]);
    }
}
