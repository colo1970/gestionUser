<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    #[Route('/personne/add', name: 'app_add_personne')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $personne = new Personne();
        $personne
           ->setFirstname("Jean")
           ->setName("Dupont")
           ->setAge(45)
           //->setJob()
           ;
           //ajouter $p1 à la trasaction
           $em->persist($personne);
           //executer la transaction
           $em->flush();
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
        ]);
    }
}
