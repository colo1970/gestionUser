<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{

    #[Route('/template', name: 'template')]
    public function template(Request $request): Response
    {
        return $this->render('/template.html.twig');
    }

    #[Route('/first', name: 'app_first')]
    public function index(Request $request): Response
    {
        //demarre la session
        $nbVisite = 0;
        $session = $request->getSession(); 
        //nieme connxion
        if($session->has("nbVisite")){
            $nbVisite = $session->get('nbVisite') +1;

        }else{//1ere connection
            $nbVisite = 1;
        }
       //maj la session
       $session->set('nbVisite', $nbVisite);
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }

    #[Route('/hello/{nom}/{prenom}', name: 'sayHello')]
    public function sayHello($nom, $prenom): Response
    {
       
        return $this->render('/first/sayHello.html.twig', [
            "nom"=>$nom,
            "prenom" => $prenom
        ]
    );
    }
}
