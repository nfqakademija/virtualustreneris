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

        return $this->render('AppBundle:Admin:index.html.twig',[
            "userCount" => $userCount
        ]);
    }

    /**
     * @Route("/admin/admin-list", name="admin_users_list")
     */
    public function adminUsersListAction()
    {
        $conn = $this->getDoctrine()->getConnection();

        $users = $conn->exec("SELECT * FROM fos_user");

        return $this->render('AppBundle:Admin:admin-list.html.twig',[
            "users" => $users
        ]);
    }

}
