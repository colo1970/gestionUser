<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
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
}
