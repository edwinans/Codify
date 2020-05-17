<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Exercice;
use App\Entity\Resolution;
use App\Repository\UserRepository;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Liip\ImagineBundle\Async\ResolveCache;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController{

     /**
     * @var ExerciceRepository
     */
    private $repository_exercices;

      /**
     * @var UserRepository
     */
    private $repository_users;

    public function __construct(ExerciceRepository $repository_exercices, EntityManagerInterface $manager, Security $security, UserRepository $repository_users)
    {
        $this->repository_exercices = $repository_exercices;
        $this->manager = $manager;
        $this->security = $security;
        $this->repository_users = $repository_users;
    }



    /**
     * @Route("/user-{id}" , name="user.show")
     * @return Response
     */
    public function show($id):Response{
        $repository_user = $this->repository_users;
        $repository_exercices = $this->repository_exercices;
       

        $user = $repository_user->find($id);
        $exercices=$repository_exercices->findAllCreated($id);
        

        return $this->render('user/show.html.twig',[
            'user'=> $user,
            'exercices'=>$exercices,
            'current_menu'=> 'user'
        ]);
    }   
}