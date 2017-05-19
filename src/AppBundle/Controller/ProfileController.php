<?php
/**
 * Created by PhpStorm.
 * User: vilius
 * Date: 17.5.8
 * Time: 13.11
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;

class ProfileController extends Controller
{

    /**
     * @Route("/profile", name="profile")
     */

    public function profileAction()
    {
        return $this->render('AppBundle:Profile:main.html.twig');
    }
}
