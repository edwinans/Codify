<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;


class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= \Faker\Factory::create('fr_FR');
        $cat=["Java","PHP","Javascript","C","Ocaml","Python"];
        //Créer 5 Catégories 
        for($i=0;$i<=5;$i++){
            $category=new Category();
            $category->setTitle($cat[$i])
                     ->setDescription($faker->paragraph());

            $manager->persist($category);

            //Créer entre 4 et 6 articles
            for($j=1;$j<= mt_rand(4,6);$j++){
                $content='<p>' .join($faker->paragraphs(5),'</p><p>').'</p>';

                $article = new Article();
                $article->setTitle($faker->sentence())
                        ->setContent($content)
                        ->setImage($faker->imageUrl())
                        ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                        ->setCategory($category);

                 $manager->persist($article);

                 for($k=1;$k<=mt_rand(4,10);$k++){
                     $comment=new Comment();
                     $content='<p>' .join($faker->paragraphs(2),'</p><p>').'</p>';

                     $now=new \DateTime();
                     $interval=$now->diff($article->getCreatedAt());
                     $days=$interval->days;
                     $minimum = '-'.$days.' days';

                     $comment->setAuthor($faker->name)
                             ->setContent($content)
                             ->setCreatedAt($faker->dateTimeBetween($minimum))
                             ->setArticle($article);
                    $manager->persist($comment);
                    
                 }
            }
        }

        $manager->flush();
    }
}
