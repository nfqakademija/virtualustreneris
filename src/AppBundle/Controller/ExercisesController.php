<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Exercises;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ExercisesType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ExercisesController extends Controller
{
    /**
     * @Route("/admin/exercises/create", name="exercises_create")
     */
    public function exerciseCreateAction(Request $request)
    {

        $form = $this->createForm(ExercisesType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('exercises_list');
        }

        return $this->render(
            'AppBundle:Admin:exercise-create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/admin/exercises/list", name="exercises_list")
     */
    public function exerciseListAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Exercises');
        $exercises = $repository->findAll();

        return $this->render(
            'AppBundle:Admin:exercise-list.html.twig',
            [
                'exercises' => $exercises
            ]
        );
    }

    /**
     * @Route("/admin/exercises/edit/{id}", name="exercises_edit")
     */
    public function exerciseEditAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Exercises');
        $exercises = $repository->find($id);

        $form = $this->createForm(ExercisesType::class, $exercises);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('exercises_list');
        }

        return $this->render(
            'AppBundle:Admin:exercise-edit.html.twig',
            [
                'exercises' => $exercises,
                'form' => $form->createView()
            ]
        );
    }

      /**
     * @Route("/admin/exercises/delete/{id}", name="exercises_delete")
     */
    public function exerciseDeleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Exercises');
        $exercise = $repository->find($id);

        $em->remove($exercise);
        $em->flush();

        return $this->redirectToRoute('exercises_list');
    }
}
