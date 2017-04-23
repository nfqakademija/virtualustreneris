<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Description;
use AppBundle\Entity\Gender;
use AppBundle\Entity\Experience;


class ProgramsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('exerciseList')
        ->add('gender', EntityType::class, [
            'placeholder' => 'Choose a gender',
            'class' => Gender::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('gender')
                ->OrderBy('gender.gender', 'ASC');
            }
        ])
        ->add('experience', EntityType::class, [
            'placeholder' => 'Choose category',
            'class' => Experience::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('exp')
                ->OrderBy('exp.experience', 'ASC');
            }
        ])
        ->add('description');
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