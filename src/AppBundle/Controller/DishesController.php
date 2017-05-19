<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\DishesType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\FoodDishes;
use AppBundle\Entity\FoodCategories;

class DishesController extends Controller
{
    /**
     * @Route("/admin/dishes/create", name="dishes_create")
     */
    public function dishCreateAction(Request $request)
    {

        $form = $this->createForm(DishesType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('dishes_list');
        }

        return $this->render(
            'AppBundle:Admin:dish-create.html.twig',
            [
            'form' => $form->createView()
            ]
        );
    }


    /**
     * @Route("/admin/dishes/list", name="dishes_list")
     */
    public function dishListAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:FoodDishes');
        $dishes = $repository->findAll();

        return $this->render(
            'AppBundle:Admin:dish-list.html.twig',
            [
            'dishes' => $dishes
            ]
        );
    }


    /**
     * @Route("/admin/dishes/edit/{id}", name="dishes_edit")
     */
    public function dishEditAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:FoodDishes');
        $dishes = $repository->find($id);


        $form = $this->createForm(DishesType::class, $dishes);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();

            return $this->redirectToRoute('dishes_list');
        }

        return $this->render(
            'AppBundle:Admin:dish-edit.html.twig',
            [
                'dishes' => $dishes,
                'form' => $form->createView()
            ]
        );
    }

     /**
     * @Route("/admin/dishes/delete/{id}", name="dishes_delete")
     */
    public function dishDeleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:FoodDishes');
        $dish = $repository->find($id);

        $em->remove($dish);
        $em->flush();

        return $this->redirectToRoute('dishes_list');
    }
}
