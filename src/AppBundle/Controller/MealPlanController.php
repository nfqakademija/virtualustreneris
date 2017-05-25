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
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Service\CalorieCalculatorService;

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

        $calorieCalculatorService = $this->get('app.calorie_calculator_service');
        $result = $calorieCalculatorService->calculate();

        $productDislikeService = $this->get('app.product_dislike_service');
        $multiChoice = $productDislikeService->showSeveralChoices();

        $meatmsg = $productDislikeService->isMeatChecked();
        $curdmsg = $productDislikeService->isCurdChecked();
        $fishmsg = $productDislikeService->isFishChecked();
        $grudaimsg = $productDislikeService->isGrudaiChecked();

        $rangeStart = $result - 100;
        $rangeEnd = $result + 100;

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:DishLists');

        $dishRepo = $em->getRepository('AppBundle:FoodDishes');
        $dishes = $dishRepo->findAll();

        $alternativeRepo = $em->getRepository('AppBundle:Alternatives');
        $alternatives = $alternativeRepo->findAll();


        $find = false;

        if (!is_null($calorieCalculatorService->getGender())) {
            if ($result > 2400 and $calorieCalculatorService->getGoals() == '2') {
                $find = $repository->findPlanByMax();
            } else {
                $find = $repository->findPlanByCalories($rangeStart, $rangeEnd, $calorieCalculatorService->getGoals());
            }

            if (!$find) {
                $this->addFlash('session', 'Atsprašome, tačiau kol kas pagal jūsų kriterijus 
                dar nėra ikeltos programos.');
            }
        } else {
            $this->addFlash('session', 'Jūs dar neesate išsirinkę mitybos programos.');
        }


        return $this->render(
            'AppBundle:Profile:index.html.twig',
            [
            'plans' => $find,
            'result' => round($result),
            'dishes' => $dishes,
            'alternatives' => $alternatives,
            'meatmsg' => $meatmsg,
            'curdmsg' => $curdmsg,
            'grudaimsg' => $grudaimsg,
            'fishmsg' => $fishmsg,
            'multichoice' => $multiChoice
            ]
        );
    }


    /**
     * @Route("/admin/meal-plan/create", name="meal_plan_create")
     */
    public function mealPlanCreateAction(Request $request)
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

        return $this->render(
            'AppBundle:Admin:meal-plan-create.html.twig',
            [
            'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/admin/meal-plan/list", name="meal_plan_list")
     */
    public function mealPlanListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:DishLists');
        $mealPlans = $repository->findAll();
        //$foodDishIds = json_decode($mealPlans["food_dish_id"]);

        $dishRepo = $em->getRepository('AppBundle:FoodDishes');
        $dishes = $dishRepo->findAll();


        return $this->render(
            'AppBundle:Admin:meal-plan-list.html.twig',
            [
            'mealPlans' => $mealPlans,
            'dishes' => $dishes
            ]
        );
    }

    /**
     * @Route("/admin/meal-plan/edit/{id}", name="meal_plan_edit")
     */
    public function mealPlanEditAction($id, Request $request)
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

        return $this->render(
            'AppBundle:Admin:meal-plan-edit.html.twig',
            [
                'mealPlan' => $mealPlan,
                'form' => $form->createView()
            ]
        );
    }

        /**
     * @Route("/admin/meal-plan/delete/{id}", name="meal_plan_delete")
     */
    public function mealPlanDeleteAction($id)
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
    public function mealPlanSearchAction()
    {

        $form = $this->createFormBuilder()
            ->add(
                'gender',
                EntityType::class,
                [
                'placeholder' => 'Pasirinkite lytį',
                'class' => Gender::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('gender')
                        ->OrderBy('gender.gender', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control'
                    )
                ]
            )
            ->add(
                'height',
                IntegerType::class,
                [
                'attr'   =>  array(
                    'class'   => 'form-control',
                    'placeholder' => 'Įveskite savo ūgį (cm)',
                    'min' => '30',
                    'max' => '220'
                )
                ]
            )
            ->add(
                'weight',
                IntegerType::class,
                [
                'attr'   =>  array(
                    'class'   => 'form-control',
                    'placeholder' => 'Įveskite savo svorį (kg)',
                    'min' => '30',
                    'max' => '150'
                )
                ]
            )
            ->add(
                'age',
                IntegerType::class,
                [
                'attr'   =>  array(
                    'class'   => 'form-control',
                    'placeholder' => 'Jūsų amžius',
                    'min' => '4',
                    'max' => '80'
                )
                ]
            )
            ->add(
                'goals',
                EntityType::class,
                [
                'placeholder' => 'Pasirinkite tikslą',
                'class' => Goals::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('goals')
                        ->orderBy('goals.title', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control')
                ]
            )
            ->add(
                'activity',
                EntityType::class,
                [
                'placeholder' => 'Jusu fizinis atkyvumas',
                'class' => Activity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('activity')
                        ->orderBy('activity.id', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control box-footer')
                ]
            )
            ->add(
                'varske',
                CheckboxType::class,
                [
                'label'    => 'Nemėgstu varškės',
                'attr'   =>  array(
                    'class'   => 'form-control'
                ),
                'required' => false
                ]
            )
            ->add(
                'mesa',
                CheckboxType::class,
                [
                'label'    => 'Nemėgstu mėsos',
                'attr'   =>  array(
                    'class'   => 'form-control'
                ),
                'required' => false
                ]
            )
            ->add(
                'grudai',
                CheckboxType::class,
                [
                'label'    => 'Nemėgstu avižinės košės',
                'attr'   =>  array(
                    'class'   => 'form-control'
                ),
                'required' => false
                ]
            )
            ->add(
                'zuvis',
                CheckboxType::class,
                [
                'label'    => 'Nemėgstu žuvies',
                'attr'   =>  array(
                    'class'   => 'form-control'
                ),
                'required' => false
                ]
            )
            ->add(
                'Ieškoti',
                SubmitType::class,
                [
                'attr'   =>  array(
                    'class'   => 'btn btn-special',
                    'style' => 'color: black;',
                ),
                ]
            )
            ->getForm();


        return $this->render(
            'AppBundle:MealPlan:index.html.twig',
            [
            'form' => $form->createView()
            ]
        );
    }


    /**
     * @Route("/meal-plan/results", name="meal_plan_result")
     */
    public function mealPlanGetResultAction(Request $request)
    {
        if (isset($request->request->get('form')['varske'])) {
            $varske = $request->request->get('form')['varske'];
        } else {
            $varske = '0';
        }

        if (isset($request->request->get('form')['mesa'])) {
            $mesa = $request->request->get('form')['mesa'];
        } else {
            $mesa = '0';
        }

        if (isset($request->request->get('form')['grudai'])) {
            $grudai = $request->request->get('form')['grudai'];
        } else {
            $grudai = '0';
        }

        if (isset($request->request->get('form')['zuvis'])) {
            $zuvis = $request->request->get('form')['zuvis'];
        } else {
            $zuvis = '0';
        }

        $gender = $request->request->get('form')['gender'];
        $height = $request->request->get('form')['height'];
        $weight = $request->request->get('form')['weight'];
        $age = $request->request->get('form')['age'];
        $goals = $request->request->get('form')['goals'];
        $activity = $request->request->get('form')['activity'];

        //Hacker trap
        if ($gender != '2' and $gender != '1' and is_null($gender)) {
            return $this->render('AppBundle:Error:index.html.twig');
        }

        $gender_error = false;
        $height_error = false;
        $weight_error = false;
        $age_error = false;
        $goals_error = false;
        $activity_error = false;

        //If wrong select
        $error = false;
        if ($gender == '' or is_null($gender)) {
            $error = true;
            $gender_error = true;
        }
        if ($height == '' or is_null($height)) {
            $error = true;
            $height_error = true;
        }
        if ($weight == '' or is_null($weight)) {
            $error = true;
            $weight_error = true;
        }
        if ($age == '' or is_null($age)) {
            $error = true;
            $age_error = true;
        }
        if ($goals == '' or is_null($goals)) {
            $error = true;
            $goals_error = true;
        }
        if ($activity == '' or is_null($activity)) {
            $error = true;
            $activity_error = true;
        }

        if ($height < '30' or $height > '220') {
            $error = true;
            $height_error = true;
        }
        if ($weight < '30' or $weight > '150') {
            $error = true;
            $weight_error = true;
        }
        if ($age < '4' or $age > '80') {
            $error = true;
            $age_error = true;
        }

        $form = $this->createFormBuilder()
            ->add(
                'gender',
                EntityType::class,
                [
                'placeholder' => 'Pasirinkite lytį',
                'class' => Gender::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('gender')
                        ->OrderBy('gender.gender', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control'
                )
                ]
            )
            ->add(
                'height',
                IntegerType::class,
                [
                'attr'   =>  array(
                    'class'   => 'form-control',
                    'placeholder' => 'Įveskite savo ūgį (cm)',
                    'min' => '30',
                    'max' => '220'
                )
                ]
            )
            ->add(
                'weight',
                IntegerType::class,
                [
                'attr'   =>  array(
                    'class'   => 'form-control',
                    'placeholder' => 'Įveskite savo svorį (kg)',
                    'min' => '30',
                    'max' => '150'
                )
                ]
            )
            ->add(
                'age',
                IntegerType::class,
                [
                'attr'   =>  array(
                    'class'   => 'form-control',
                    'placeholder' => 'Jūsų amžius',
                    'min' => '4',
                    'max' => '80'
                )
                ]
            )
            ->add(
                'goals',
                EntityType::class,
                [
                'placeholder' => 'Pasirinkite tikslą',
                'class' => Goals::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('goals')
                        ->orderBy('goals.title', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control')
                ]
            )
            ->add(
                'activity',
                EntityType::class,
                [
                'placeholder' => 'Jusu fizinis atkyvumas',
                'class' => Activity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('activity')
                        ->orderBy('activity.id', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control box-footer')
                ]
            )
            ->add(
                'varske',
                CheckboxType::class,
                [
                'label'    => 'Nemėgstu varškės',
                'attr'   =>  array(
                    'class'   => 'form-control'
                ),
                'required' => false
                ]
            )
            ->add(
                'mesa',
                CheckboxType::class,
                [
                'label'    => 'Nemėgstu mėsos',
                'attr'   =>  array(
                    'class'   => 'form-control'
                ),
                'required' => false
                ]
            )
            ->add(
                'grudai',
                CheckboxType::class,
                [
                'label'    => 'Nemėgstu grudų',
                'attr'   =>  array(
                    'class'   => 'form-control'
                ),
                'required' => false
                ]
            )
            ->add(
                'zuvis',
                CheckboxType::class,
                [
                'label'    => 'Nemėgstu žuvies',
                'attr'   =>  array(
                    'class'   => 'form-control'
                ),
                'required' => false
                ]
            )
            ->add(
                'Ieškoti',
                SubmitType::class,
                [
                'attr'   =>  array(
                    'class'   => 'btn btn-special',
                    'style' => 'color: black;',
                ),
                ]
            )
            ->getForm();

        if ($error) {
            return $this->render(
                'AppBundle:MealPlan:index.html.twig',
                [
                'form' => $form->createView(),
                "gender"   =>  $gender_error,
                "height"   =>  $height_error,
                "weight"   =>  $weight_error,
                "age"      =>  $age_error,
                "goals"    =>  $goals_error,
                "activity" =>  $activity_error
                ]
            );
        }

        $session = new Session();

        $session->set('grudai', $grudai);
        $session->set('zuvis', $zuvis);
        $session->set('mesa', $mesa);
        $session->set('varske', $varske);
        $session->set('gender', $gender);
        $session->set('height', $height);
        $session->set('weight', $weight);
        $session->set('age', $age);
        $session->set('goals', $goals);
        $session->set('activity', $activity);

        return $this->redirectToRoute('profile_meal_plan');
    }
}
