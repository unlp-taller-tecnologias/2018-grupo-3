<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Rol;
use Symfony\Component\Security\Core\Security;

class UsuarioUpdateType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')
        ->add('apellido')
        ->add('telefonoContacto')
        ->add('email')
        ->add('username')
        ->add('rol', EntityType::class, array(
            'label' => 'Rol',
            'required' => true,
            'class' => 'AppBundle:Rol',
            'choice_label' => function($rol){
                return $rol->getNombre();
            },
            'expanded' => false));
        // if ($options) {
            $builder->add('catedra');
        // }
        $builder->add('visado');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario'
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_usuario';
    }


}
