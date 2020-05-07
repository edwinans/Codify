<?php

namespace App\Form;

use App\Entity\ExerciceFiltre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class ExerciceFiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxDifficulte',IntegerType::class,[
                'required'=>false,
                'label'=>false,
                'attr'=>[
                    'placeholder'=> 'Difficulte Maximale'
                ]
            ])
            ->add('minDifficulte',IntegerType::class,[
                'required'=>false,
                'label'=>false,
                'attr'=>[
                    'placeholder'=> 'Difficulte Minimale'
                ]
            ])
            //button submit aded on the html index
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ExerciceFiltre::class,
            'method'=> 'get',
            'csrf_protection'=>false,
        ]);
    }

    //permet de vider le champ get, il sera propre
    public function getBlockPrefix(){
        return '';
    }
}
