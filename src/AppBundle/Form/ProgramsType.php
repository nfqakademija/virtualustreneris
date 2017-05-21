<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Gender;
use AppBundle\Entity\Experience;
use AppBundle\Entity\Goals;
use AppBundle\Entity\AgeCategory;

class ProgramsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'exerciseList',
                null,
                [
                'attr'   =>  array(
                    'class'   => 'form-control'),
                'label' => 'Pirmos dienos pratimų ID'
                ]
            )
            ->add(
                'exerciseListTwo',
                null,
                [
                'attr'   =>  array(
                    'class'   => 'form-control'),
                'label' => 'Antros dienos pratimų ID'
                ]
            )
            ->add(
                'exerciseListThree',
                null,
                [
                'attr'   =>  array(
                    'class'   => 'form-control'),
                'label' => 'Trečios dienos pratimų ID'
                ]
            )
            ->add(
                'exerciseListFour',
                null,
                [
                'attr'   =>  array(
                    'class'   => 'form-control'),
                'label' => 'Ketvirtos dienos pratimų ID'
                ]
            )
            ->add(
                'gender',
                EntityType::class,
                [
                'placeholder' => 'Parinkite lytį',
                'class' => Gender::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('gender')
                        ->OrderBy('gender.gender', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control'),
                'label' => 'Lytis'
                ]
            )
            ->add(
                'experience',
                EntityType::class,
                [
                'placeholder' => 'Parinkite pažangumą',
                'class' => Experience::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('exp')
                        ->OrderBy('exp.experience', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control'),
                'label' => 'Pažangumas'
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
                'ageCategory',
                EntityType::class,
                [
                'placeholder' => 'Parinkite amžiaus kategoriją',
                'class' => AgeCategory::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('age')
                        ->OrderBy('age.id', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control'),
                'label' => 'Amžiaus kategorija'
                ]
            )
            ->add(
                'goals',
                EntityType::class,
                [
                'placeholder' => 'Parinkite tikslą',
                'class' => Goals::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('goals')
                        ->orderBy('goals.title', 'ASC');
                },
                'attr' => array(
                    'class' => 'form-control'),
                'label' => 'Tikslas'
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
            'data_class' => 'AppBundle\Entity\Programs'
            )
        );
    }
}
