<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use App\Trait\Sluggable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelRepository::class)]
class Model
{
    use Sluggable;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $brand = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $power = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $year = null;

    #[ORM\ManyToOne]
    private ?Energy $energy = null;

    #[ORM\OneToMany(mappedBy: 'model', targetEntity: UserCar::class)]
    private Collection $userCars;

    public function __construct()
    {
        $this->userCars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): static
    {
        $this->power = $power;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getEnergy(): ?Energy
    {
        return $this->energy;
    }

    public function setEnergy(?Energy $energy): static
    {
        $this->energy = $energy;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getBrand().' '.$this->getName().' '.$this->getYear().' '.$this->getEnergy();
    }

    /**
     * @return Collection<int, UserCar>
     */
    public function getUserCars(): Collection
    {
        return $this->userCars;
    }

    public function addUserCar(UserCar $userCar): static
    {
        if (!$this->userCars->contains($userCar)) {
            $this->userCars->add($userCar);
            $userCar->setModel($this);
        }

        return $this;
    }

    public function removeUserCar(UserCar $userCar): static
    {
        if ($this->userCars->removeElement($userCar)) {
            // set the owning side to null (unless already changed)
            if ($userCar->getModel() === $this) {
                $userCar->setModel(null);
            }
        }

        return $this;
    }
}
