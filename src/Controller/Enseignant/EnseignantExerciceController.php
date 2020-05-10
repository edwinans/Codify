<?php

namespace App\Controller\Enseignant;

use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class EnseignantExerciceController extends AbstractController{
    /**
     * @var ExerciceRepository
     */
    private $repository;
    
    public function __construct(ExerciceRepository $repository,EntityManagerInterface $manager){
        $this->manager=$manager;
        $this->repository=$repository;
    }

    /**
     * @Route("/enseignant",name="enseignant.exercice.index")
     */
    public function index():Response{
        $exercices=$this->repository->findAll();
        return $this->render('enseignant/exercice/index.html.twig',[
            'exercices'=>$exercices,
            'current_menu'=>'enseignant'
        ]);
    }


    /**
     * @Route("/enseignant/exercice/create",name="enseignant.exercice.new")
     */
    public function new(Request $request){
        $exercice=new Exercice();

        $form=$this->createForm(ExerciceType::class,$exercice);
        $form->handleRequest($request);  //gere la requete
        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($exercice);
            $this->manager->flush();
            $this->addFlash('success','Bien créé avec succés');
            return $this->redirectToRoute('enseignant.exercice.index'); //listing des exos
        }
        return $this->render('enseignant/exercice/new.html.twig',[
            'exercice'=>$exercice,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/enseignant/exercice/{id}",name="enseignant.exercice.edit",methods="GET|POST")
     */
    public function edit(Exercice $exercice, Request $request){

        $form=$this->createForm(ExerciceType::class,$exercice);
        $form->handleRequest($request);  //gere la requete

        if($form->isSubmitted() && $form->isValid()){
            $this->manager->flush();
            $this->addFlash('success','Bien modifié avec succés');
            return $this->redirectToRoute('enseignant.exercice.index'); //listing des exos
        }

        return $this->render('enseignant/exercice/edit.html.twig',[
            'exercice'=>$exercice,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/enseignant/exercice/{id}",name="enseignant.exercice.delete",methods="DELETE")
     */
    public function delete(Exercice $exercice,Request $request){
        if($this->isCsrfTokenValid('delete'. $exercice->getId(),$request->get('_token'))){
            $this->manager->remove($exercice);
            $this->manager->flush();
            $this->addFlash('success','Bien supprimé avec succés');
        }
       
        return $this->redirectToRoute('enseignant.exercice.index'); //listing des exos
    }
}
    
