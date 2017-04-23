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
use AppBundle\Form\ProgramsType;


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

    	return $this->render('sportPlan/sport-plan-create.html.twig', [
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

            return $this->render('sportPlan/sport-plan-list.html.twig', [
                'sportPlans' => $sportPlans
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

        return $this->render('sportPlan/sport-plan-edit.html.twig', [
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
 }