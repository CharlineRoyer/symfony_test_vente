<?php

namespace App\Controller;

use App\Entity\Poster;
use App\Form\PosterFormType;
use App\Repository\PosterRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PosterController extends AbstractController
{
    /**
     * @Route("/poster", name="poster")
     */
    public function index(PosterRepository $repo): Response
    {
        $posters = $repo->findAll();

        return $this->render('poster/index.html.twig', [
            'controller_name' => 'PosterController',
            'posters'=>$posters,
        ]);
    }


    /**
     * @Route("/poster/{nom}/{prix}", name="poster_add")
     */
    public function ajout($nom, $prix, ManagerRegistry $mr): Response
    {   
        $manager = $mr->getManager();
        $poster = new Poster();
        $poster->setNom($nom);
        $poster->setPrix($prix);
        $poster->setTaille(42);
        $poster->setDescription("blibliblibli");

        $manager->persist($poster);
        $manager->flush();
        
        dd($poster);
        // die();

        return $this->render('poster/index.html.twig', [
            'controller_name' => 'PosterController',
        ]);
    }


    /**
     * @Route("/poster/{id}", name="onePoster")
     */
    public function getOne(PosterRepository $repo, $id): Response
    {   
    
        $poster = $repo->find($id);
       
        // die();

        return $this->render('poster/description.html.twig', [
            'controller_name' => 'PosterController',
            'poster'=>$poster
        ]);
    }

    /**
     * @Route("/posterAgrandir/{id}/{nom}/{taille}/{prix}/{description}", name="onePosteragrandir")
     */
    public function ModifyOne(PosterRepository $repo, $id, $nom, $taille, $prix, $description,  ManagerRegistry $mr): Response
    {   
    
        $poster = $repo->find($id);
        $ancienPrix = $poster->getPrix();
        $ancienNom= $poster->getNom();
        $ancienneTaille = $poster->getTaille();
        $ancienneDescription = $poster->getDescription();

        $manager = $mr->getManager();
        if($ancienNom != $nom){
            $poster->setNom($nom);
        }

        if($ancienneTaille != $taille){
            $poster->setTaille($taille);
        }

        if($ancienPrix != $prix){
            $poster->setPrix($prix);
        }

        if($ancienneDescription!= $description){
            $poster->setDescription($description);
        } 

      
        $manager->persist($poster);
        $manager->flush();


        dd($poster);
        // die();

        return $this->render('poster/description.html.twig', [
            'controller_name' => 'PosterController',
            // 'poster'=>$poster
        ]);
    }

    /**
     * @Route("/poster_delete/{id}/", name="poster_delete")
     */
    public function deleteOne(PosterRepository $repo, $id,  ManagerRegistry $mr): Response
    {   
        $manager = $mr->getManager();
        $poster = $repo->find($id);       
        $manager->remove($poster);
        $manager->flush();
      

        return $this->redirectToRoute('poster');
    }

    /**
     * @Route("/poster_add", name="poster_add")
     */
    public function addOne(Request $r, ManagerRegistry $mr, PosterRepository $repo): Response
    {   
        $poster = new Poster;
      
        $form = $this->createForm(PosterFormType::class, $poster);

        $form->handleRequest($r);

        if($form->isSubmitted()&& $form->isValid()){
            $manager=$mr->getManager();
            $manager->persist($poster);
            $manager->flush();
            return $this->redirectToRoute('poster');


        }

           return $this->render('poster/form_add_modify.html.twig', [
            'titre' => 'ajouter',
            'form'=>$form->createView()
          
           ]);
    }

     /**
     * @Route("/poster_modify/{id}", name="poster_modify")
     */
    public function modifyOnePoster(Request $r, ManagerRegistry $mr, Poster $poster): Response
    {        
        $form = $this->createForm(PosterFormType::class, $poster);

        $form->handleRequest($r);

        if($form->isSubmitted()&& $form->isValid()){
            $manager=$mr->getManager();
            $manager->persist($poster);
            $manager->flush();
            return $this->redirectToRoute('poster');


        }

           return $this->render('poster/form_add_modify.html.twig', [
            'titre' => 'modifier',
            'form'=>$form->createView(),
            'poster'=>$poster
            // 'poster'=>$poster
        ]);
    }

    
    }







