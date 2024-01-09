<?php

namespace App\Trait;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\Mapping as ORM;

#[UniqueEntity('slug')]
trait Sluggable
{
    #[ORM\Column(length: 255, unique: true)]
    private ?string $slug = null;

    public function computeSlug(SluggerInterface $slugger, string $name): void
    {
        if (!$this->slug || '-' === $this->slug) {
            $this->slug = (string) $slugger->slug($name)->lower();
        }
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}