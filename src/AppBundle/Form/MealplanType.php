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
        ->add('caloriesNum')
        ->add('foodDishId')
        ->add('goals', EntityType::class, [
            'placeholder' => 'Choose your goal',
            'class' => Goals::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('goal')
                ->OrderBy('goal.title', 'ASC');
            }
        ]);
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\DishLists'
        ));
    }

}