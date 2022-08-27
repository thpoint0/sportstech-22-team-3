<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GlassesController extends AbstractController
{
    #[Route('/glasses', name: 'app_glasses')]
    public function index(): Response
    {
        return $this->render('glasses/index.html.twig', [
            'controller_name' => 'GlassesController',
        ]);
    }
}
