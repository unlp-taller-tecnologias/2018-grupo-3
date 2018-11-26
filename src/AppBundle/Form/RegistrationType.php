<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')
        ->add('apellido')
        ->add('catedra')
        ->add('visado')
        ->add('rol', ChoiceType::class, array(
                'label' => 'Rol',
                'required' => true,
                'choices' => array('rol_admin' => 'admin', 'rol_moderador' => 'moderador' ),
                'multiple' => true));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public function getExistingRoles()
    {
        // $roleHierarchy = $this->container->getParameter('security.role_hierarchy.roles');
        // $roles = array_keys($roleHierarchy);

        // foreach ($roles as $role) {
        //     $theRoles[$role] = $role;
        // }
        // return $theRoles;
    }
}