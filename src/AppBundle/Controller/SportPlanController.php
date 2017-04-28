<?php

namespace AppBundle\Controller;

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
     * @Route("/profile/sport-plan", name="profile_sport_plan")
     */
    public function profileAction()
    {
        $session = new Session();
        $gender = $session->get('gender');
        $experience = $session->get('experience');
        $age = $session->get('age');
        $goals = $session->get('goals');

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Programs');
        $find = $repository->findSportPlan($gender, $experience, $goals);

        $exerciseRepo = $em->getRepository('AppBundle:Exercises');
        $exercises = $exerciseRepo->findAll();

        if(!$find) {
            $this->addFlash('message', 'Atsiprašome, kol kas pagal jūsų kriterijus dar nėra įkeltos sporto programos.');
        }

        return $this->render('AppBundle:Profile:sport-plan.html.twig', [
            'plans' => $find,
            'exercises' => $exercises
        ]);
    }


    /**
     * @Route("/admin/sport-plan/create", name="sport_plan_create")
     */
    public function SportPlanCreateAction(Request $request)
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

    	return $this->render('AppBundle:Admin:sport-plan-create.html.twig', [
    		'form' => $form->createView()
    		]);
    }

        /**
         * @Route("/admin/sport-plan/list", name="sport_plan_list")
         */
        public function SportPlanListAction(Request $request)
        {

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AppBundle:Programs');
            $sportPlans = $repository->findAll();

            $exercisesRepo = $em->getRepository('AppBundle:Exercises');
            $exercises = $exercisesRepo->findAll();

            return $this->render('AppBundle:Admin:sport-plan-list.html.twig', [
                'sportPlans' => $sportPlans,
                'exercises' => $exercises
                ]);
        }

        /**
     * @Route("/admin/sport-plan/edit/{id}", name="sport_plan_edit")
     */
    public function SportPlanEditAction($id, Request $request)
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

        return $this->render('AppBundle:Admin:sport-plan-edit.html.twig', [
                'sportPlan' => $sportPlan,
                'form' => $form->createView()
            ]);
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

    /**
     * @Route("/sport-plan/search", name="sport_plan_search")
     */
    public function SportPlanSearchAction()
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
            ->add('experience', EntityType::class, [
                'placeholder' => 'Jusu patirtis',
                'class' => Experience::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('experience')
                        ->OrderBy('experience.experience', 'ASC');
                },
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('age', null, [
                'attr'   =>  array(
                    'class'   => 'form-control',
                    'placeholder' => 'Jūsų amžius skaičiais')
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
            ->add('Ieškoti', SubmitType::class, [
                'attr'   =>  array(
                    'class'   => 'btn btn-success')
            ])
            ->getForm();


        return $this->render('AppBundle:SportPlan:index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/sport-plan/results", name="sport_plan_result")
     */
    public function SportPlanGetResultAction(Request $request)
    {
        $gender = $request->request->get('form')['gender'];
        $experience = $request->request->get('form')['experience'];
        $age = $request->request->get('form')['age'];
        $goals = $request->request->get('form')['goals'];

        $session = new Session();

        $session->set('gender', $gender);
        $session->set('experience', $experience);
        $session->set('age', $age);
        $session->set('goals', $goals);

        return $this->redirectToRoute('profile_sport_plan');
    }
 }