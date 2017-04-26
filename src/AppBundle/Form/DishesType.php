<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\FoodDishes;
use AppBundle\Entity\FoodCategories;


class DishesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('description', null, [
            'attr'   =>  array(
                'class'   => 'form-control')
        ])
        ->add('proteinNum', null, [
            'attr'   =>  array(
                'class'   => 'form-control')
        ])
        ->add('carbohydrateNum', null, [
            'attr'   =>  array(
                'class'   => 'form-control')
        ])
        ->add('fatNum', null, [
            'attr'   =>  array(
                'class'   => 'form-control')
        ])
        ->add('sugarNum', null, [
            'attr'   =>  array(
                'class'   => 'form-control')
        ])
        ->add('foodCategories', EntityType::class, [
            'placeholder' => 'Parinkite kategoriją',
            'class' => FoodCategories::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('cat')
                ->OrderBy('cat.title', 'ASC');
            },
            'attr'   =>  array(
                'class'   => 'form-control')
        ]);
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\FoodDishes'
        ));
    }

}