<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Model;
use App\Entity\UserCar;
use App\Form\UserCarType;

class ModelController extends AbstractController
{
    #[Route('/marque/{brand_slug}/modele/{slug}', name: 'model_show')]
    public function show(Model $model): Response
    {
        $userCar = new UserCar();
        $form = $this->createForm(UserCarType::class, $userCar);

        return $this->render('model/show.html.twig', [
            'model' => $model,
            'userCarForm' => $form,
        ]);
    }
}
