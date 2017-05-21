<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ExercisesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'title',
            null,
            [
            'attr'   =>  array(
                'class'   => 'form-control'),
            'label' => 'Pavadinimas'
            ]
        )
            ->add(
                'description',
                null,
                [
                'attr'   =>  array(
                    'class'   => 'form-control'),
                'label' => 'Aprašymas'
                ]
            )
            ->add(
                'repeats',
                null,
                [
                'attr'   =>  array(
                    'class'   => 'form-control'),
                'label' => 'Pakartojimai'
                ]
            )
            ->add(
                'explanation',
                null,
                [
                'label' => 'Pratimo demonstracija'
                ]
            );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
            'data_class' => 'AppBundle\Entity\Exercises'
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_exercises';
    }
}
