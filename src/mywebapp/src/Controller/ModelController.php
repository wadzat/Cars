<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModelController extends AbstractController
{
    #[Route('/modele/{id}', name: 'model_show')]
    public function index(): Response
    {
        return $this->render('model/index.html.twig', [
            'model' => 'jiji',
        ]);
    }
}
