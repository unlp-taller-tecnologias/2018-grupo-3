<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VisadoChoiceType extends AbstractType{
    public function configureOptions(OptionsResolver $resolver)
    {
       
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}