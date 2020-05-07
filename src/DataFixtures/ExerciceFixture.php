<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Comment;
use App\Entity\Category;
use App\Entity\Exercice;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ExerciceFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create('fr_FR');

        //créé les catégories parmis :
        $cat=["Java","Ocaml","Php","C","Python","JavaScript"];
        for($i=0;$i<count($cat);$i++){
            $category=new Category();
            $category->setTitle($cat[$i])
                     ->setDescription($faker->paragraph());
            $manager->persist($category);

            for($j=1;$j<=mt_rand(12,20);$j++){
                $exercice=new Exercice();
                $exercice
                    ->setTitle($faker->words(3,true))
                    ->setDescription($faker->sentences(3,true))
                    //->setImage($faker->imageUrl())
                    ->setDifficulte($faker->numberBetween(0,5))
                    ->setCategory($category)
                    ->setCreatedAt($faker->dateTimeBetween('-6months'));
                $manager->persist($exercice);
            
                for($k=1;$k<=mt_rand(3,7);$k++){
                    $comment=new Comment();
                    $content='<p>'. join($faker->paragraphs(2),'</p><p>').'</p>';
                    $days=(new \DateTime())->diff($exercice->getCreatedAt())->days;
                    $comment->setAuthor($faker->name)
                            ->setContent($content)
                            ->setCreatedAt($faker->dateTimeBetween('-'. $days .' days'))
                            ->setExercice($exercice);
                    $manager->persist($comment);
                }
            }
        }
            $manager->flush();
    }
}
