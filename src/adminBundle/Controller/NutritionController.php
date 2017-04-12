<?php
/**
 * Created by PhpStorm.
 * User: vilius
 * Date: 17.4.11
 * Time: 10.19
 */

namespace adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NutritionController extends controller
{
    /**
     * @Route("/programmes/nutrition")
     */
    public function nutritionListAction()
    {
        return $this->render('adminBundle:Programmes:nutrition-list.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/programmes/nutrition/create")
     */
    public function nutritionCreateAction()
    {
        return $this->render('adminBundle:Programmes:nutrition-create.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/programmes/nutrition/edit/{id}")
     */
    public function nutritionEditAction($id)
    {
        return $this->render('adminBundle:Programmes:nutrition-edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/programmes/nutrition/delete/{id}")
     */
    public function nutritionDeleteAction($id)
    {
        return $this->render('adminBundle:Programmes:nutrition-delete.html.twig', array(
            // ...
        ));
    }


}