<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use App\Repository\ModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/marque/{slug}', name: 'brand_show')]
    public function show(Request $request, ModelRepository $modelRepository, Brand $brand): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $modelRepository->getModelPaginator($brand,$offset);


        return $this->render('brand/show.html.twig', [
            'brand' => $brand,
            'models' => $paginator,
            'previous' => $offset - ModelRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + ModelRepository::PAGINATOR_PER_PAGE)
        ]);
    }
}
