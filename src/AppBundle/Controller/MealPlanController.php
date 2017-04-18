<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;

class MealPlanController extends Controller
{

    /**
     * @Route("/mitybos-programos", name="meal-plan")
     */
    public function mealAction()
    {
        return $this->render('AppBundle:MealPlan:index.html.twig');
    }


    /**
     * @Route("admin/mitybos-programos/list", name="meal-plan-list")
     */
    public function mealListAction()
    {
        return $this->render('AppBundle:MealPlan:list.html.twig');
    }

    /**
     * @Route("admin/mitybos-programos/show/{id}", name="meal-plan-show")
     */
    public function mealShowAction($id)
    {
        return $this->render('AppBundle:MealPlan:show.html.twig');
    }

    /**
     * @Route("admin/mitybos-programos/edit/{id}", name="meal-plan-edit")
     */
    public function mealEditAction($id)
    {
        return $this->render('AppBundle:MealPlan:edit.html.twig');
    }

    /**
     * @Route("admin/mitybos-programos/delete/{id}", name="meal-plan-delete")
     */
    public function mealDeleteAction($id)
    {
        return $this->render('AppBundle:MealPlan:delete.html.twig');
    }

}
