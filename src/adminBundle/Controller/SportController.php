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

class SportController extends controller
{

    /**
     * @Route("/programmes/sport")
     */
    public function sportListAction()
    {
        return $this->render('adminBundle:Programmes:sport-list.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/programmes/sport/create")
     */
    public function sportCreateAction()
    {
        return $this->render('adminBundle:Programmes:sport-create.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/programmes/sport/edit/{id}")
     */
    public function sportEditAction($id)
    {
        return $this->render('adminBundle:Programmes:sport-edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/programmes/sport/delete/{id}")
     */
    public function sportDeleteAction($id)
    {
        return $this->render('adminBundle:Programmes:sport-delete.html.twig', array(
            // ...
        ));
    }


}