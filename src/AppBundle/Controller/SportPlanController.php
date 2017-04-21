<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;

class SportPlanController extends Controller
{

    /**
     * @Route("/sporto-programos", name="sport-plan")
     */
    public function sportAction()
    {
        return $this->render('AppBundle:SportPlan:index.html.twig');
    }

}
