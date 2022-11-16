<?php

namespace App\Entity;

use App\Repository\ComputerRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComputerRepository::class)]
class Computer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $macAdress = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    private ?string $system = null;


    #[ORM\ManyToOne(inversedBy: 'computers')]
    private ?Departement $idDepartement = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $purchase = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMacAdress(): ?string
    {
        return $this->macAdress;
    }

    public function setMacAdress(string $macAdress): self
    {
        $this->macAdress = $macAdress;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSystem(): ?string
    {
        return $this->system;
    }

    public function setSystem(string $system): self
    {
        $this->system = $system;

        return $this;
    }


    public function getIdDepartement(): ?Departement
    {
        return $this->idDepartement;
    }

    public function setIdDepartement(?Departement $idDepartement): self
    {
        $this->idDepartement = $idDepartement;

        return $this;
    }

    public function getPurchase(): ?\DateTimeInterface
    {
        return $this->purchase;
    }

    public function setPurchase(\DateTimeInterface $purchase): self
    {
        $this->purchase = $purchase;

        return $this;
    }
}
