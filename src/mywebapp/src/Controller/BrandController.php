<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use App\Repository\ModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController
{
    #[Route('/marques', name: 'brand_list')]
    public function index(BrandRepository $brandRepository): Response
    {
        return $this->render('brand/index.html.twig', [
            'brands' => $brandRepository->findby([], ['name' => 'ASC']),
        ]);
    }

    #[Route('/marque/{id}', name: 'brand_show')]
    public function show(BrandRepository $brandRepository, ModelRepository $modelRepository, Brand $brand): Response
    {
        return $this->render('brand/show.html.twig', [
            'brand' => $brand,
            'models' => $modelRepository->findBy(['brand' => $brand], ['name' => 'ASC']),
        ]);
    }
}
