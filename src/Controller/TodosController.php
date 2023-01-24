<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodosController extends AbstractController
{
    #[Route('/todo', name: 'app_todos')]
    public function index(Request $request): Response
    {
      
        $session = $request->getSession();
        if(!$session->has('todos')){
            $todos = [
                'achat'=>'Acheter clé Usb',
                'cours'=>'Finaliser mon cours',
                'correction' =>'Corriger mes examens'
            ];
            $session->set('todos', $todos);
        }
        return $this->render('todos/index.html.twig');
    }

    #[Route('/todo/add/{name}/{content}', name: 'app_add_todos')]
    public function addTodo(Request $request, $name, $content): Response
    {
        $session = $request->getSession();
        if($session->has('todos')){
            $tabTodo = $session->get('todos');
            if(isset($tabTodo[$name])){
               $this->addFlash("info", "ce name existe deja");
            }else{
                $tabTodo[$name]= $content;
                $session->set('todos',$tabTodo);
                $this->addFlash("success", "$name bien ajouté");
            }
       
        }
        return $this->redirectToRoute('app_todos');
    }
}
