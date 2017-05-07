<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\MealplanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\DishLists;
use AppBundle\Entity\Goals;
use AppBundle\Entity\Gender;
use AppBundle\Repository\DishListsRepository;
use AppBundle\Repository\GoalsRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
     * @Route("/profile/meal-plan", name="profile_meal_plan")
     */
    public function profileAction()
    {
        $session = new Session();
        $gender = $session->get('gender');
        $height = $session->get('height');
        $weight = $session->get('weight');
        $age = $session->get('age');
        $goals = $session->get('goals');
        $activity = $session->get('activity');


        if ($gender=='1') {
            $calories = 664.7 + (5 * $height) + (13.75 * $weight) - (6.74 * $age);
            if($goals=='1') {
                $result = $calories + 300;
            }else{
                $result = $calories - 300;
            }
        }else{
            $calories = 655.1 + (1.85 * $height) + (9.6 * $weight) - (6.74 * $age);
            if($goals=='1') {
                $result = $calories + 200;
            }else{
                $result = $calories - 200;
            }
        }

        if($activity == '1') {
            $result +=0;
        }elseif($activity == '2') {
            $result +=50;
        }elseif($activity == '3') {
            $result +=100;
        }elseif($activity == '4') {
            $result +=150;
        }elseif($activity == '5') {
            $result +=200;
        }

        $rangeStart = $result - 150;
        $rangeEnd = $result + 150;

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:DishLists');
        $find = $repository->findPlanByCalories($rangeStart, $rangeEnd, $goals);

        $dishRepo = $em->getRepository('AppBundle:FoodDishes');
        $dishes = $dishRepo->findAll();

        if(!$find) {
            $this->addFlash('message', 'Atsiprašome, kol kas pagal jūsų kriterijus dar nėra įkeltos mitybos programos.');
        }

        return $this->render('AppBundle:Profile:index.html.twig', [
            'plans' => $find,
            'result' => round($result),
            'dishes' => $dishes
        ]);
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


        $form = $this->createForm(MealplanType::class, $mealPlan);

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


    /**
     * @Route("/meal-plan/search", name="meal_plan_search")
     */
    public function MealPlanSearchAction()
    {

        $form = $this->createFormBuilder()
            ->add('gender', EntityType::class, [
                'placeholder' => 'Pasirinkite lytį',
                'class' => Gender::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('gender')
                        ->OrderBy('gender.gender', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('height', IntegerType::class, [
                'attr'   =>  array(
                    'class'   => 'form-control',
                    'placeholder' => 'Įveskite savo ūgį (cm)',
                    'min' => '30',
                    'max' => '220'
                )
            ])
            ->add('weight', IntegerType::class, [
                'attr'   =>  array(
                    'class'   => 'form-control',
                    'placeholder' => 'Įveskite savo svorį (kg)',
                    'min' => '30',
                    'max' => '150'
                )
            ])
            ->add('age', IntegerType::class, [
                'attr'   =>  array(
                    'class'   => 'form-control',
                    'placeholder' => 'Jūsų amžius',
                    'min' => '4',
                    'max' => '80'
                )
            ])
            ->add('goals', EntityType::class, [
                'placeholder' => 'Pasirinkite tikslą',
                'class' => Goals::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('goals')
                        ->orderBy('goals.title', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('activity', EntityType::class, [
                'placeholder' => 'Jusu fizinis atkyvumas',
                'class' => Activity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('activity')
                        ->orderBy('activity.id', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control box-footer')
            ])
            ->add('Ieškoti', SubmitType::class, [
                'attr'   =>  array(
                    'class'   => 'btn btn-special',
                    'style' => 'color: black;')
            ])
            ->getForm();


        return $this->render('AppBundle:MealPlan:index.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/meal-plan/results", name="meal_plan_result")
     */
    public function MealPlanGetResultAction(Request $request)
    {
        $gender = $request->request->get('form')['gender'];
        $height = $request->request->get('form')['height'];
        $weight = $request->request->get('form')['weight'];
        $age = $request->request->get('form')['age'];
        $goals = $request->request->get('form')['goals'];
        $activity = $request->request->get('form')['activity'];

        $session = new Session();

        $session->set('gender', $gender);
        $session->set('height', $height);
        $session->set('weight', $weight);
        $session->set('age', $age);
        $session->set('goals', $goals);
        $session->set('activity', $activity);

        return $this->redirectToRoute('profile_meal_plan');
    }


}
