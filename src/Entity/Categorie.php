<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Produit::class)]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setCategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCategorie() === $this) {
                $produit->setCategorie(null);
            }
        }

        return $this;
    }
}
