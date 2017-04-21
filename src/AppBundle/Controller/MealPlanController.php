<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\MealplanType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\DishLists;
use AppBundle\Entity\Goals;


class MealPlanController extends Controller
{

    /**
     * @Route("/mitybos-programos", name="meal-plan")
     */
    public function mealAction()
    {
        return $this->render('AppBundle:MealPlan:index.html.twig');
    }


    /**
     * @Route("/meal-plan/create", name="meal_plan_create")
     */
    public function MealPlanCreateAction(Request $request)
    {

    	$form = $this->createForm(MealplanType::class);

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
    		$result = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('meal_plan_list');
    	}

    	return $this->render('default/meal-plan-create.html.twig', [
    		'form' => $form->createView()
    		]);
    }

    /**
     * @Route("/meal-plan/list", name="meal_plan_list")
     */
    public function MealPlanListAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:DishLists');
        $mealPlans = $repository->findAll();

        return $this->render('default/meal-plan-list.html.twig', [
            'mealPlans' => $mealPlans
            ]);
    }

    /**
     * @Route("/meal-plan/edit/{id}", name="meal_plan_edit")
     */
    public function MealPlanEditAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:DishLists');
        $mealPlan = $repository->find($id);


        $form = $this->createFormBuilder($mealPlan)
            ->add('caloriesNum')
            ->add('foodDishId')
            ->add('goals', EntityType::class, [
                'placeholder' => 'Choose your goal',
                'class' => Goals::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('goal')
                    ->OrderBy('goal.title', 'ASC');
                }
             ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('meal_plan_list');
        }

        return $this->render('default/meal-plan-edit.html.twig', [
                'mealPlan' => $mealPlan,
                'form' => $form->createView()
            ]);
        }

        /**
     * @Route("/meal-plan/delete/{id}", name="meal_plan_delete")
     */
     public function MealPlanDeleteAction($id)
     {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:DishLists');
        $mealPlan = $repository->find($id);

        $em->remove($mealPlan);
        $em->flush();

        return $this->redirectToRoute('meal_plan_list');
     }
}
