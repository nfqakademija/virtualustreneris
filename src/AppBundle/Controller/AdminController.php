<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;

class AdminController extends Controller
{

    /**
     * @Route("/admin/", name="admin_page")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare("SELECT * FROM fos_user");
        $stmt->execute();
        $info = $stmt->fetchAll();

        return $this->render(
            'AppBundle:Admin:index.html.twig',
            [
            "info" => $info
            ]
        );
    }
}
