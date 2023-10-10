<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (type: 'integer')]
    private $id;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $commande_date = null;

    #[ORM\Column(type: 'string', length: 15, nullable: false, options:['collation' => 'utf8_general_ci'])]
    private $statut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getCommandeDate(): ?\DateTimeInterface
    {
        return $this->commande_date;
    }

    public function setCommandeDate(\DateTimeInterface $commande_date): static
    {
        $this->commande_date = $commande_date;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
