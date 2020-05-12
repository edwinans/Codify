<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Exercice;
use App\Form\CommentType;
use App\Entity\ExerciceFiltre;
use App\Form\ExerciceFiltreType;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class ExerciceController extends AbstractController{


    /**
     * @var ExerciceRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var Security
     */
    private $security;

    public function __construct(ExerciceRepository $repository,EntityManagerInterface $manager,Security $security){
        $this->repository = $repository ;
        $this->manager = $manager ;
        $this->security =$security;
    }




    /**
     * @Route("/exercices" , name="exercice.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator,Request $request):Response{
        $search=new ExerciceFiltre();
        $form=$this->createForm(ExerciceFiltreType::class,$search);
        $form->handleRequest($request);



        $exercices=$paginator->paginate(
            $this->repository->findAllQuery($search),
            $request->query->getInt('page',1),
            12
        );
        return $this->render('exercice/index.html.twig',[
            'current_menu'=> 'exercices',
            'exercices'=>$exercices,
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/exercices/{slug}-{id}",name="exercice.show",requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug,$id,Request $request,EntityManagerInterface $manager):Response{
        $comment=new Comment();
        $form =$this->createForm(CommentType::class,$comment);
        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(Exercice::class);
        $exercice = $repository->find($id);
    
        if($form->isSubmitted() && $form->isValid()){
            $comment->setCreatedAt(new \DateTime())
                    ->setExercice($exercice)
                    ->setAuthor($this->security->getUser()->getUsername());
                    

            $manager->persist($comment);
            $manager->flush();
            return $this->redirectToRoute('exercice.show',[
                'id'=>$id,
                'slug'=>'exercices'
            ]);
        }
        $exercice=$this->repository->find($id);
        $myfile=__DIR__ .'/../../public/images/exercices/'.$exercice->getFilename();
        $fn = fopen($myfile,'r');
        while(!feof($fn)){
            $result[] = fgets($fn);
        }
        fclose($fn);

        return $this->render('exercice/show.html.twig',[
            'solutions'=>$result,
            'exercice'=> $exercice,
            'current_menu'=> 'exercices',
            'commentForm'=>$form->createView()
        ]);
    }   

    /**
     * @Route("/exercices/{slug}-{id}/play",name="exercice.play",requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function play($slug,$id){
        $exercice=$this->repository->find($id);
        $myfile=__DIR__ .'/../../public/images/exercices/'.$exercice->getFilename();
        $fn = fopen($myfile,'r');
        while(!feof($fn)){
            $result[] = fgets($fn);
        }
        fclose($fn);
        return $this->render('exercice/probleme.html.twig',[
            'solutions'=>$result,
            'exercice'=> $exercice
            
        ]);
    }
}