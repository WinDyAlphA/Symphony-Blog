<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TghippoController extends AbstractController
{
    #[Route('/tghippo', name: 'app_tghippo')]
    public function index(): Response
    {
        return $this->render('tghippo/index.html.twig', [
            'controller_name' => 'TghippoController',
        ]);
    }
}
