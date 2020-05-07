<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class ExerciceFiltre{
    /**
     * @var int|null
     * @Assert\Range(min=0,max=5)
     */
    private $maxDifficulte; 
    //to DO remplacer maxDifficulte par catégory


    /**
     * @var int|null
     * @Assert\Range(min=0,max=5)
     */
    private $minDifficulte;



    /**
     * @return int|null
     */
    public function getMaxDifficulte(){
        return $this->maxDifficulte;
    }

    /**
     * @return ExerciceFiltre
     */
    public function setMaxDifficulte(int $difficulte){
       $this->maxDifficulte =$difficulte;
       return $this;
    }




    /**
     * @return int|null
     */
    public function getMinDifficulte(){
        return $this->minDifficulte;
    }

     /**
     * @return ExerciceFiltre
     */
    public function setMinDifficulte(int $difficulte){
        $this->minDifficulte =$difficulte;
        return $this;
     }
}