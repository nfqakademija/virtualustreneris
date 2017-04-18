<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;

class HomeController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $conn = $this->getDoctrine()->getConnection();

        //$conn->exec("insert into gender (gender) values ('other')");

        return $this->render('AppBundle:Home:index.html.twig');
    }
    
}
