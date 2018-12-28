<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VisadoChoiceType extends AbstractType{
    public function configureOptions(OptionsResolver $resolver)
    {
       
    }

    public function getBlockPrefix(){
    	return "visadochoice";
    }

    public function getParent()
    {
        return EntityType::class;
    }
}