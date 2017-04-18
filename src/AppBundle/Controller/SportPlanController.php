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


    /**
     * @Route("admin/sporto-programos/list", name="sport-plan-list")
     */
    public function sportListAction()
    {
        return $this->render('AppBundle:SportPlan:list.html.twig');
    }

    /**
     * @Route("admin/sporto-programos/show/{id}", name="sport-plan-show")
     */
    public function sportShowAction($id)
    {
        return $this->render('AppBundle:SportPlan:show.html.twig');
    }

    /**
     * @Route("admin/sporto-programos/edit/{id}", name="sport-plan-edit")
     */
    public function sportEditAction($id)
    {
        return $this->render('AppBundle:SportPlan:edit.html.twig');
    }

    /**
     * @Route("admin/sporto-programos/delete/{id}", name="sport-plan-delete")
     */
    public function sportDeleteAction($id)
    {
        return $this->render('AppBundle:SportPlan:delete.html.twig');
    }

}
