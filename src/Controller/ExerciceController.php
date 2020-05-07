<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExerciceController extends AbstractController{


    /**
     * @var ExerciceRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ExerciceRepository $repository,EntityManagerInterface $manager){
        $this->repository = $repository ;
        $this->manager = $manager ;
    }




    /**
     * @Route("/exercices" , name="exercice.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator,Request $request):Response{
        $exercices=$paginator->paginate(
            $this->repository->findAllQuery(),
            $request->query->getInt('page',1),
            12
        );
        return $this->render('exercice/index.html.twig',[
            'current_menu'=> 'exercices',
            'exercices'=>$exercices
        ]);
    }

    /**
     * @Route("/exercices/{slug}-{id}",name="exercice.show",requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug,$id):Response{
        $exercice=$this->repository->find($id);
        return $this->render('exercice/show.html.twig',[
            'exercice'=> $exercice,
            'current_menu'=> 'exercices'
        ]);
    }   
}