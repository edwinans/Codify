<?php

namespace App\Controller\Admin;

use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminExerciceController extends AbstractController{
    /**
     * @var ExerciceRepository
     */
    private $repository;
    public function __construct(ExerciceRepository $repository,EntityManagerInterface $manager){
        $this->manager=$manager;
        $this->repository=$repository;
    }

    /**
     * @Route("/admin",name="admin.exercice.index")
     */
    public function index():Response{
        $exercices=$this->repository->findAll();
        return $this->render('admin/exercice/index.html.twig',compact('exercices'));
    }


    /**
     * @Route("/admin/exercice/create",name="admin.exercice.new")
     */
    public function new(Request $request){
        $exercice=new Exercice();

        $form=$this->createForm(ExerciceType::class,$exercice);
        $form->handleRequest($request);  //gere la requete
        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($exercice);
            $this->manager->flush();
            $this->addFlash('success','Bien créé avec succés');
            return $this->redirectToRoute('admin.exercice.index'); //listing des exos
        }
        return $this->render('admin/exercice/new.html.twig',[
            'exercice'=>$exercice,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/admin/exercice/{id}",name="admin.exercice.edit",methods="GET|POST")
     */
    public function edit(Exercice $exercice, Request $request){

        $form=$this->createForm(ExerciceType::class,$exercice);
        $form->handleRequest($request);  //gere la requete

        if($form->isSubmitted() && $form->isValid()){
            $this->manager->flush();
            $this->addFlash('success','Bien modifié avec succés');
            return $this->redirectToRoute('admin.exercice.index'); //listing des exos
        }

        return $this->render('admin/exercice/edit.html.twig',[
            'exercice'=>$exercice,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/admin/exercice/{id}",name="admin.exercice.delete",methods="DELETE")
     */
    public function delete(Exercice $exercice,Request $request){
        if($this->isCsrfTokenValid('delete'. $exercice->getId(),$request->get('_token'))){
            $this->manager->remove($exercice);
            $this->manager->flush();
            $this->addFlash('success','Bien supprimé avec succés');
        }
       
        return $this->redirectToRoute('admin.exercice.index'); //listing des exos
    }
}
    
