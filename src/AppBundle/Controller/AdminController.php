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
        $conn = $this->getDoctrine()->getConnection();
        $userCount = $conn->exec("SELECT COUNT(*) as total FROM fos_user") + 1;

        //$users = $conn->exec("SELECT * FROM fos_user");
        $users = array();

        return $this->render('AppBundle:Admin:index.html.twig',[
            "userCount" => $userCount,
            "users" => $users
        ]);
    }

}
