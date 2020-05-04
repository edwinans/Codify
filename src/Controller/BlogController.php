<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use App\Form\CommentType;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**  
     * @Route("/blog", name="blog") 
     */
    public function index(ArticleRepository $repo)
    {
        $repo=$this->getDoctrine()->getRepository(Article::class);

        $articles=$repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/",name="home")
     */
    public function home(){
        return $this->render('blog/home.html.twig',[
            'title'=> "Bienvenue ici les amis"
        ]);
    }

    /**
     * @Route("/blog/new",name="blog_create")
     * @Route("/blog/{id}/edit",name="blog_edit")
     */
    public function form(Article $article=null,Request $request,ObjectManager $manager){  
        //article null dans le cas de creation 
        if(!$article){
            $article=new Article();
        }
       

        $form=$this->createFormBuilder($article)
                   ->add('title')
                   ->add('category',EntityType::class,[
                       'class'=>Category::class,
                       'choice_label'=> 'title'
                   ])
                   ->add('content')
                   ->add('image')
                   ->getForm();
                   
        $form->handleRequest($request); //est ce que tout va bien ? champs rempli ? 
        // il bind l'attribut avec l'attribut de l'article

        if($form -> isSubmitted() && $form->isValid()){
            if(!$article->getId()){
                 $article->setCreatedAt(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show',[
                'id'=>$article->getId()
            ]);
        }
        return $this->render('blog/create.html.twig',[
            'formArticle'=> $form->createView(),
            'editMode'=> $article->getId()!==null
        ]);
    }

     /**
     * @Route("/blog/{id}",name="blog_show")
     */
    public function show(Article $article,Request $request,ObjectManager $manager){   //$id
       // $repo= $this->getDoctrine()->getRepository(Article::class);
       // $article=$repo->find($id);
        $comment=new Comment();
        $form = $this->createForm(CommentType::class,$comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setCreatedAt(new \DateTime())
                    ->setArticle($article);
            $manager->persist($comment);
            $manager->flush();
            
            return $this->redirectToRoute('blog_show',['id'=>$article->getId()]) ;
        }

        return $this->render('blog/show.html.twig',[
            'article'=> $article,
            'commentForm'=> $form->createView()
        ]);
    }

    

}
