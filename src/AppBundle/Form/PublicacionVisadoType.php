<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Publicacion;

class PublicacionVisadoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('aprobada', EntityType::class, array('label' => 'Publicacion',
        'required' => false,
        'class' => 'AppBundle:Publicacion',
        'query_builder' => function($publicacion){
            return $publicacion->createQueryBuilder('p')->where('p.aprobada = 0');
        },
        'choice_label' => function($publicacion){
            return $publicacion->getTitulo();
        },
        'expanded' => true,
        'multiple' => true ));
        // foreach ($options['data'] as $pPV) {
        //   $builder ->add('Aprobar'.$pPV->getId(), CheckboxType::class);
        // }
        // $builder ->add('Confirmar', SubmitType::class);

    }

    /**
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
