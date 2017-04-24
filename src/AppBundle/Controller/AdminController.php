<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;

class AdminController extends Controller
{

    /**
     * @Route("/admin", name="admin_page")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Admin:index.html.twig');
    }

}
