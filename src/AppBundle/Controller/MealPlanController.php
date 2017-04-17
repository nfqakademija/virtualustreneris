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

}
