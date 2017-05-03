<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('exerciseList', null, [
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('gender', EntityType::class, [
                'placeholder' => 'Choose a gender',
                'class' => Gender::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('gender')
                        ->OrderBy('gender.gender', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('experience', EntityType::class, [
                'placeholder' => 'Choose category',
                'class' => Experience::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('exp')
                        ->OrderBy('exp.experience', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('description', null, [
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('ageCategory', EntityType::class, [
                'placeholder' => 'Amžiaus kategorija',
                'class' => AgeCategory::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('age')
                        ->OrderBy('age.id', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('goals', EntityType::class, [
                'placeholder' => 'Pasirinkite tikslą',
                'class' => Goals::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('goals')
                        ->orderBy('goals.title', 'ASC');
                },
                'attr' => array(
                    'class' => 'form-control')
            ]);
    }

    
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Programs'
        ));
    }

}