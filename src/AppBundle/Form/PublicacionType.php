<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
        $builder->add('titulo')
        ->add('bajada', TextareaType::class, array('attr' => array('class' => 'tinymce') ))
        ->add('nombreAutor')
        ->add('fechaPublicacion', DateType::class, array(
            'widget' => 'single_text',
            'disabled' => 'true'))
        ->add('contenido', CKEditorType::class, array( 'config' => array( 'uiColor' => '#ffffff' )))
        ->add('fechaCaducidad', DateType::class, array('widget' => 'single_text'))
        ->add('firmante')
        ->add('archivo', FileType::class, array(
            'label' => 'Archivo pdf'))
        ->add('link1')
        ->add('link2')
        ->add('link3')
        ->add('link4')
        ->add('link5')
        ->add('etiqueta')
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
