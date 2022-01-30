<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoucpController extends AbstractController
{
    /**
     * @Route("/coucp", name="coucp")
     */
    public function index(): Response
    {
        return $this->render('coucp/index.html.twig', [
            'controller_name' => 'CoucpController',
        ]);
    }
}
