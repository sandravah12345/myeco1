<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type:'string', length: 50, nullable: false, options:['collation' => 'utf8_general_ci'])]
    private $name;

    #[ORM\Column(type:'string', length: 255, nullable: false, options:['collation' => 'utf8_general_ci'])]
    private $description;

    #[ORM\Column(type:'float', nullable: false)]
    private $price;

    #[ORM\Column(type:'string', length: 60, nullable: false, options:['collation' => 'utf8_general_ci'])]
    private $image;

    #[ORM\Column(type:'float', nullable: false)]
    private $stock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getStock(): ?float
    {
        return $this->stock;
    }

    public function setStock(float $stock): static
    {
        $this->stock = $stock;

        return $this;
    }
}