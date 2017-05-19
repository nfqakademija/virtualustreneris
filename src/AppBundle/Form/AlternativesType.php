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

class AlternativesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'dishId',
                null,
                [
                'attr'   =>  array(
                    'class'   => 'form-control'),
                'label' => 'Patiekalo ID, kurį keisite'
                ]
            )
            ->add(
                'description',
                null,
                [
                'attr'   =>  array(
                'class'   => 'form-control'),
                'label' => 'Patiekalo aprašymas'
                ]
            )
            ->add(
                'proteinNum',
                null,
                [
                'attr'   =>  array(
                'class'   => 'form-control'),
                'label' => 'Baltymai'
                ]
            )
            ->add(
                'carbohydrateNum',
                null,
                [
                'attr'   =>  array(
                'class'   => 'form-control'),
                'label' => 'Angliavandeniai'
                ]
            )
            ->add(
                'fatNum',
                null,
                [
                'attr'   =>  array(
                'class'   => 'form-control'),
                'label' => 'Riebalai'
                ]
            )
            ->add(
                'sugarNum',
                null,
                [
                'attr'   =>  array(
                'class'   => 'form-control'),
                'label' => 'Cukrus'
                ]
            )
            ->add(
                'kcalNum',
                null,
                [
                'attr'   =>  array(
                    'class'   => 'form-control'),
                'label' => 'Kalorijos'
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
            'data_class' => 'AppBundle\Entity\Alternatives'
            )
        );
    }
}
