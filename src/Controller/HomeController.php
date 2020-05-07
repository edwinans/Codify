<?php

namespace App\Controller ;

use Twig\Environment;
use App\Repository\ExerciceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{

    /**
     * @Route("/",name="home")
     * @return Response
     */
    public function index (ExerciceRepository $repository) :Response{
        $exercices = $repository->findLatest();
        return $this->render('pages/home.html.twig',[
            'exercices'=>$exercices
        ]);
    }

   

}