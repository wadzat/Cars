<?php

namespace App\EventListener;

use App\Entity\Brand;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Brand::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Brand::class)]
class BrandEntityListener
{
    public function __construct(
        private SluggerInterface $slugger,
    ) {
    }

    public function prePersist(Brand $brand, PrePersistEventArgs $event): void
    {
        $brand->computeSlug($this->slugger);
    }

    public function preUpdate(Brand $brand, PreUpdateEventArgs $event): void
    {
        $brand->computeSlug($this->slugger);
    }

}