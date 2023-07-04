<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TotsController extends AbstractController
{
    #[Route('/tots', name: 'app_tots')]
    public function index(): Response
    {
        $letters = [
            "a", "b", "c"

        ];

        return $this->render('index.html.twig', 
            [
              "letters" => $letters  ,
              "title" => "TRE"
            ]
                
            );
    }
}
