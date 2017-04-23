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
use AppBundle\Repository\DishListsRepository;

class MealPlanController extends Controller
{

    /**
     * @Route("/meal-plan", name="meal-plan")
     */
    public function mealAction()
    {
        return $this->render('AppBundle:MealPlan:index.html.twig');
    }


    /**
     * @Route("/admin/meal-plan/create", name="meal_plan_create")
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

    	return $this->render('AppBundle:Admin:meal-plan-create.html.twig', [
    		'form' => $form->createView()
    		]);
    }

    /**
     * @Route("/admin/meal-plan/list", name="meal_plan_list")
     */
    public function MealPlanListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:DishLists');
        $mealPlans = $repository->findAll();
        //$foodDishIds = json_decode($mealPlans["food_dish_id"]);

        $dishRepo = $em->getRepository('AppBundle:FoodDishes');
        $dishes = $dishRepo->findAll();


        return $this->render('AppBundle:Admin:meal-plan-list.html.twig', [
            'mealPlans' => $mealPlans,
            'dishes' => $dishes
        ]);
    }

    /**
     * @Route("/admin/meal-plan/edit/{id}", name="meal_plan_edit")
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

        return $this->render('AppBundle:Admin:meal-plan-edit.html.twig', [
                'mealPlan' => $mealPlan,
                'form' => $form->createView()
            ]);
        }

        /**
     * @Route("/admin/meal-plan/delete/{id}", name="meal_plan_delete")
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
