<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id = null;

    #[ORM\Column(type:'string', length: 10, nullable: false, options:['collation' => 'utf8_general_ci'])]
    private $homme;

    #[ORM\Column(type: 'string', length: 10, nullable:false, options:['collation' => 'utf8_general_ci'])]
    private $femme;

    #[ORM\Column(type: 'string', length: 10, nullable:false, options:['collation' => 'utf8_general_ci'])]
    private $enfant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getHomme(): ?string
    {
        return $this->homme;
    }

    public function setHomme(string $homme): static
    {
        $this->homme = $homme;

        return $this;
    }

    public function getFemme(): ?string
    {
        return $this->femme;
    }

    public function setFemme(string $femme): static
    {
        $this->femme = $femme;

        return $this;
    }

    public function getEnfant(): ?string
    {
        return $this->enfant;
    }

    public function setEnfant(string $enfant): static
    {
        $this->enfant = $enfant;

        return $this;
    }
}
