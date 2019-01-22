<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Catedra;
use AppBundle\Entity\Usuario;

class PublicacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo', TextType::class, array('attr' => array('maxlength' => 255)))
        ->add('bajada', TextareaType::class, array(
            'attr' => array('class' => 'tinymce',
                            'maxlength' => 255)))
        ->add('fechaPublicacion', DateType::class, array(
            'widget' => 'single_text',
            'disabled' => 'true'))
        ->add('contenido', CKEditorType::class, array(
            'config' => array( 'uiColor' => '#ffffff' ),
            'required' => true ))
        ->add('fechaCaducidad', DateType::class, array(
            'widget' => 'single_text',
            'required' => false))
        ->add('firmante', TextType::class, array('required' => false, 'attr' => array('maxlength' => 255)))
        ->add('archivo', FileType::class, array(
            'label' => 'Archivo',
            "attr" =>array("class" => "form-control"),
            "data_class" => null,
            "required" => false ))
        ->add('etiqueta', EntityType::class, array(
            'class' => 'AppBundle:Etiqueta',
            'required' => true ))
        ->add('usuarioPublicacion', EntityType::class, array(
            'class' => 'AppBundle:Usuario',
            'disabled' => 'true' ))
        ->add('catedra', EntityType::class, array(
            'disabled' => true,
            'class' => 'AppBundle:Catedra', ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Publicacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_publicacion';
    }


}
