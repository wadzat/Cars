<?php

namespace App\EventListener;

use App\Entity\Model;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Model::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Model::class)]
class ModelEntityListener
{
    public function __construct(
        private SluggerInterface $slugger,
    ) {
    }

    public function prePersist(Model $model, PrePersistEventArgs $event): void
    {
        $model->computeSlug($this->slugger, $model->getName());
    }

    public function preUpdate(Model $model, PreUpdateEventArgs $event): void
    {
        $model->computeSlug($this->slugger, $model->getName());
    }
}