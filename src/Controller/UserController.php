<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Exercice;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController{

    /**
     * @Route("/user-{id}" , name="user.show")
     * @return Response
     */
    public function show($id):Response{
        $repository_user = $this->getDoctrine()->getRepository(User::class);
        $repository_exercices = $this->getDoctrine()->getRepository(Exercice::class);

        $user = $repository_user->find($id);
        $exercices=$repository_exercices->findAllCreated($id);

        return $this->render('user/show.html.twig',[
            'user'=> $user,
            'exercices'=>$exercices,
            'current_menu'=> 'user'
        ]);
    }   
}