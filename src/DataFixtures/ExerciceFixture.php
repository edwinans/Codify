<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class ExerciceFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create('fr_FR');
        for($i=0;$i<100;$i++){
            $exercice=new Exercice();
            $exercice
                    ->setTitle($faker->words(3,true))
                    ->setDescription($faker->sentences(3,true))
                    ->setDifficulte($faker->numberBetween(0,5));
                    
            $manager->persist($exercice);
        }
            $manager->flush();
    }
}
