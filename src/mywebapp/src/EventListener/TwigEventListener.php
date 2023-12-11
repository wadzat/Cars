<?php

namespace App\EventListener;

use App\Repository\BrandRepository;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

final class TwigEventListener
{
    public function __construct(private Environment $twig, private BrandRepository $brandRepository)
    {}

    #[AsEventListener(event: KernelEvents::CONTROLLER)]
    public function onKernelController(ControllerEvent $event): void
    {
        $this->twig->addGlobal('brands', $this->brandRepository->findAll());
    }
}
