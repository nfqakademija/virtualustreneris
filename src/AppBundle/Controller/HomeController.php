<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {


        $session = new Session();
        $gender = $session->get('gender');
        $sportGender = $session->get('sport-gender');


        if(!is_null($gender) || !is_null($sportGender)) {
           $this->addFlash('sessionMessage', 'Jūs jau turite profilyje išsaugoję programų.');
        }

       $user = $this->get('app.current_user_service')->getUser();

        return $this->render('AppBundle:Home:index.html.twig');
    }


    
}
