<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\DishLists;
use AppBundle\Entity\Goals;

class MealplanType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'caloriesNum',
                null,
                [
                'attr'   =>  array(
                'class'   => 'form-control'),
                'label' => 'Kalorijų skaičius'
                ]
            )
            ->add(
                'foodDishId',
                null,
                [
                'attr'   =>  array(
                'class'   => 'form-control'),
                'label' => 'Pateikalų ID'
                ]
            )
            ->add(
                'goals',
                EntityType::class,
                [
                'placeholder' => 'Parinkite tikslą',
                'class' => Goals::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('goal')
                        ->OrderBy('goal.title', 'ASC');
                },
                'attr'   =>  array(
                'class'   => 'form-control'),
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
            'data_class' => 'AppBundle\Entity\DishLists'
            )
        );
    }
}
