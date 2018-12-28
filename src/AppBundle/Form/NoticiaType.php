<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Usuario;


class NoticiaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo')
        ->add('bajada', TextareaType::class, array('attr' => array('class' => 'tinymce') ))
        ->add('fechaPublicacion', DateType::class, array(
            'widget' => 'single_text',
            'disabled' => 'true'))
        ->add('fechaCaducidad', DateType::class, array(
            'widget' => 'single_text',
            'required' => false))
        ->add('contenido', CKEditorType::class, array( 'config' => array( 'uiColor' => '#ffffff' )))
        ->add('link1')
        ->add('link2')
        ->add('link3')
        ->add('link4')
        ->add('link5')
        ->add('firmante', TextType::class, array('required' => false))
        ->add('usuarioNoticia', EntityType::class, array(
            'class' => 'AppBundle:Usuario',
            'disabled' => 'true' ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Noticia'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_noticia';
    }


}
