<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AgeCategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Programs;
use AppBundle\Entity\Gender;
use AppBundle\Entity\Experience;
use AppBundle\Entity\Goals;
use AppBundle\Form\ProgramsType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;

class SportPlanController extends Controller
{

    /**
     * @Route("/sport-plan", name="sport-plan")
     */
    public function sportAction()
    {
        return $this->render('AppBundle:SportPlan:index.html.twig');
    }

    /**
     * @Route("/profile/back-plan", name="profile_back_plan")
     */

    public function backPlanListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Programs');
        $find = $repository->findBackPlan();

        $exerciseRepo = $em->getRepository('AppBundle:Exercises');
        $exercises = $exerciseRepo->findAll();


        return $this->render(
            'AppBundle:Profile:back-plan.html.twig',
            [
                'plans' => $find,
                'exercises' => $exercises
            ]
        );
    }

    /**
     * @Route("/profile/sport-plan", name="profile_sport_plan")
     */
    public function profileAction()
    {
        $session = new Session();
        $gender = $session->get('sport-gender');
        $experience = $session->get('experience');
        $ageCategory = $session->get('ageCategory');
        $goals = $session->get('sport-goals');

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Programs');
        $find = $repository->findSportPlan($gender, $experience, $goals, $ageCategory);

        $exerciseRepo = $em->getRepository('AppBundle:Exercises');
        $exercises = $exerciseRepo->findAll();

        if ($session->has('sport-gender')) {
            if (!$find) {
                $this->addFlash(
                    'message',
                    'Atsiprašome, kol kas pagal jūsų kriterijus dar nėra įkeltos sporto programos.'
                );
                $session->remove('sport-gender');
            }
        } else {
            $this->addFlash('session', 'Jūs dar neesate išsirinkę sporto programos.');
        }



        return $this->render(
            'AppBundle:Profile:sport-plan.html.twig',
            [
            'plans' => $find,
            'exercises' => $exercises
            ]
        );
    }

    /**
     * @Route("/profile/clear", name="profile_clear")
     */

    public function profileClear()
    {
        $session = new Session();
        $session->clear();

        $this->addFlash('success', 'Programos sėkmingai pašalintos');

        return $this->redirectToRoute('profile');
    }

    /**
     * @Route("/admin/sport-plan/create", name="sport_plan_create")
     */
    public function sportPlanCreateAction(Request $request)
    {

        $form = $this->createForm(ProgramsType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('sport_plan_list');
        }

        return $this->render(
            'AppBundle:Admin:sport-plan-create.html.twig',
            [
            'form' => $form->createView()
            ]
        );
    }

        /**
         * @Route("/admin/sport-plan/list", name="sport_plan_list")
         */
    public function sportPlanListAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Programs');
        $sportPlans = $repository->findAll();

        $exercisesRepo = $em->getRepository('AppBundle:Exercises');
        $exercises = $exercisesRepo->findAll();

        return $this->render(
            'AppBundle:Admin:sport-plan-list.html.twig',
            [
            'sportPlans' => $sportPlans,
            'exercises' => $exercises
                ]
        );
    }

        /**
     * @Route("/admin/sport-plan/edit/{id}", name="sport_plan_edit")
     */
    public function sportPlanEditAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Programs');
        $sportPlan = $repository->find($id);


        $form = $this->createForm(ProgramsType::class, $sportPlan);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('sport_plan_list');
        }

        return $this->render(
            'AppBundle:Admin:sport-plan-edit.html.twig',
            [
                'sportPlan' => $sportPlan,
                'form' => $form->createView()
            ]
        );
    }


        /**
         * @Route("/admin/sport-plan/delete/{id}", name="sport_plan_delete")
         */
    public function sportPlanDeleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Programs');
        $sportPlan = $repository->find($id);

        $em->remove($sportPlan);
        $em->flush();

        return $this->redirectToRoute('sport_plan_list');
    }

    private function createFormBuilderForSportPlan()
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
                        'class'   => 'form-control')
                ]
            )
            ->add(
                'experience',
                EntityType::class,
                [
                    'placeholder' => 'Jusu patirtis',
                    'class' => Experience::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('experience')
                            ->OrderBy('experience.experience', 'DESC');
                    },
                    'attr'   =>  array(
                        'class'   => 'form-control')
                ]
            )
            ->add(
                'ageCategory',
                EntityType::class,
                [
                    'placeholder' => 'Amžiaus kategorija',
                    'class' => AgeCategory::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('age')
                            ->OrderBy('age.id', 'ASC');
                    },
                    'attr'   =>  array(
                        'class'   => 'form-control')
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
                'Susidaryk',
                SubmitType::class,
                [
                    'attr'   =>  array(
                        'class'   => 'btn btn-special',
                        'style' => 'color: black;')
                ]
            )
            ->getForm();

        return $form;
    }

    /**
     * @Route("/sport-plan/search", name="sport_plan_search")
     */
    public function sportPlanSearchAction()
    {

        $form = $this->createFormBuilderForSportPlan();


        return $this->render(
            'AppBundle:SportPlan:index.html.twig',
            [
            'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/sport-plan/results", name="sport_plan_result")
     */
    public function sportPlanGetResultAction(Request $request)
    {
        $gender = $request->request->get('form')['gender'];
        $experience = $request->request->get('form')['experience'];
        $ageCategory = $request->request->get('form')['ageCategory'];
        $goals = $request->request->get('form')['goals'];

        //Hacker trap
        if ($gender != '2' and $gender != '1' and is_null($gender)) {
            return $this->render('AppBundle:Error:index.html.twig');
        }

        //xx
        $gender_error = false;
        $experience_error = false;
        $ageCategory_error = false;
        $goals_error = false;

        //If wrong select
        $error = false;
        if ($gender == '' or is_null($gender)) {
            $error = true;
            $gender_error = true;
        }
        if ($experience == '' or is_null($experience)) {
            $error = true;
            $experience_error = true;
        }
        if ($ageCategory == '' or is_null($ageCategory)) {
            $error = true;
            $ageCategory_error = true;
        }
        if ($goals == '' or is_null($goals)) {
            $error = true;
            $goals_error = true;
        }

        $form123 = $this->createFormBuilderForSportPlan();

        if ($error) {
            $form = $this->SportPlanSearchAction();
            return $this->render(
                'AppBundle:SportPlan:index.html.twig',
                [
                'form'        => $form123->createView(),
                "gender"      => $gender_error,
                "experience"  => $experience_error,
                "ageCategory" => $ageCategory_error,
                "goals"       => $goals_error
                ]
            );
        }

        $session = new Session();

        $session->set('sport-gender', $gender);
        $session->set('experience', $experience);
        $session->set('ageCategory', $ageCategory);
        $session->set('sport-goals', $goals);

        return $this->redirectToRoute('profile_sport_plan');
    }
}
