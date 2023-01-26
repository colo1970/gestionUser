<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/todo', name: 'app_')]
class TodosController extends AbstractController
{
    #[Route('/', name: 'todos')]
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

    #[Route('/add/{name}/{content}', name: 'add_todos')]
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

    
    #[Route('/update/{name}/{content}', name: 'update_todos')]
    public function updateTodo(Request $request, $name, $content): Response
    {
        $session = $request->getSession();
        if($session->has('todos')){ //est cequ la session contient un tableau todos
            $tabTodo = $session->get('todos');
            if(!isset($tabTodo[$name])){
               $this->addFlash("info", "ce name n'existe pas");
            }else{
                $tabTodo[$name]= $content;
                $session->set('todos', $tabTodo);
                $this->addFlash("success", " $name a été bien modifié ");
            }
       
        }
        return $this->redirectToRoute('app_todos');
    }

    #[Route('/delete/{name}', name: 'delete_todos')]
    public function deleteTodo(Request $request, $name): Response
    {
        $session = $request->getSession();
        if($session->has('todos')){ //est cequ la session contient un tableau todos
            $tabTodo = $session->get('todos');
            if(!isset($tabTodo[$name])){
               $this->addFlash("info", "ce name n'existe pas");
            }else{
                unset($tabTodo[$name]);
                $session->set('todos', $tabTodo);
                $this->addFlash("success", " $name a été bien supprimé ");
            }
       
        }
        return $this->redirectToRoute('app_todos');
    }

    #[Route('/reset', name: 'reset_todos')]
    public function resetTodo(Request $request): Response
    {
        $session = $request->getSession();
        $session->remove('todos');
        $this->addFlash("success", "Session supprimé ");
        return $this->redirectToRoute('app_todos');
    }
}
