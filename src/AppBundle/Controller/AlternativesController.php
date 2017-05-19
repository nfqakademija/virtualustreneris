<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\AlternativesType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Alternatives;

class AlternativesController extends Controller
{
    /**
     * @Route("/admin/alternatives/create", name="alternatives_create")
     */
    public function alternativeCreateAction(Request $request)
    {

        $form = $this->createForm(AlternativesType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('alternatives_list');
        }

        return $this->render(
            'AppBundle:Admin:alternative-create.html.twig',
            [
            'form' => $form->createView()
            ]
        );
    }


    /**
     * @Route("/admin/alternatives/list", name="alternatives_list")
     */
    public function dishListAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Alternatives');
        $alternatives = $repository->findAll();

        return $this->render(
            'AppBundle:Admin:alternative-list.html.twig',
            [
            'alternatives' => $alternatives
            ]
        );
    }


    /**
     * @Route("/admin/alternatives/edit/{id}", name="alternatives_edit")
     */
    public function alternativeEditAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Alternatives');
        $alternatives = $repository->find($id);


        $form = $this->createForm(AlternativesType::class, $alternatives);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('alternatives_list');
        }

        return $this->render(
            'AppBundle:Admin:alternative-edit.html.twig',
            [
                'alternatives' => $alternatives,
                'form' => $form->createView()
            ]
        );
    }

     /**
     * @Route("/admin/alternatives/delete/{id}", name="alternatives_delete")
     */
    public function alternativeDeleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Alternatives');
        $alternative = $repository->find($id);

        $em->remove($alternative);
        $em->flush();

        return $this->redirectToRoute('alternatives_list');
    }
}
