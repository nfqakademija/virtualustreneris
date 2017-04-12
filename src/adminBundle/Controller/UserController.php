<?php

namespace adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class UserController extends Controller
{
    /**
     * @Route("/users")
     */
    public function indexAction()
    {
        return $this->render('adminBundle:Users:user-list.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/users/create")
     */
    public function createUserAction()

    {

        return $this->render('adminBundle:Users:create_user.html.twig');
    }

    /**
     * @Route("/users/{id}")
     */
    public function showUserAction($id)
    {
        return $this->render('adminBundle:Users:user.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/users/{id}/edit")
     */
    public function editUserAction($id)
    {
        return $this->render('adminBundle:Users:edit_user.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/users/{id}/delete")
     */
    public function deleteUserAction($id)
    {
        return $this->render('adminBundle:Users:delete_user.html.twig', array(
            // ...
        ));
    }

}
