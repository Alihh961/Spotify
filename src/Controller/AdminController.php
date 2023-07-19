<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//! using #[IsGranted('ROLE_ADMIN')] to verify if the user is an admin or no , the redirecting must be specified in routes.yaml while in the next example we will specify the redirecting inside the controller

// #[IsGranted('ROLE_ADMIN')]
// class AdminController extends AbstractController
// {

//     #[Route('/admin', name: 'app_admin')]
//     public function index(): Response
//     {
//         return $this->render('admin/index.html.twig', [
//             'controller_name' => 'AdminController',
//         ]);
//     }
// }

class AdminController extends AbstractController
{

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->render('admin/index.html.twig', [
                'controller_name' => 'AdminController',
            ]);
        }

        return $this->redirectToRoute("app_home");
    }
}
