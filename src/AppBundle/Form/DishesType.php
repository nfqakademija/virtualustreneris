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
        ->add('description')
        ->add('proteinNum')
        ->add('carbohydrateNum')
        ->add('fatNum')
        ->add('sugarNum')
        ->add('foodCategories', EntityType::class, [
            'placeholder' => 'Choose category',
            'class' => FoodCategories::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('cat')
                ->OrderBy('cat.title', 'ASC');
            }
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