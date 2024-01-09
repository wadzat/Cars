<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Model;

class ModelController extends AbstractController
{
    #[Route('/marque/{brand_slug}/modele/{slug}', name: 'model_show')]
    public function show(Model $model): Response
    {
        return $this->render('model/show.html.twig', [
            'model' => $model
        ]);
    }
}
