<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=LigneCommandeProduit::class, mappedBy="produit")
     */
    private $lignecommandeproduits;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="produit")
     */
    private $categorie;

    public function __construct()
    {
        $this->lignecommandeproduits = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Lignecommandeproduit[]
     */
    public function getLignecommandeproduits(): Collection
    {
        return $this->lignecommandeproduits;
    }

    public function addLignecommandeproduit(Lignecommandeproduit $lignecommandeproduit): self
    {
        if (!$this->lignecommandeproduits->contains($lignecommandeproduit)) {
            $this->lignecommandeproduits[] = $lignecommandeproduit;
            $lignecommandeproduit->setProduit($this);
        }

        return $this;
    }

    public function removeLignecommandeproduit(Lignecommandeproduit $lignecommandeproduit): self
    {
        if ($this->lignecommandeproduits->removeElement($lignecommandeproduit)) {
            // set the owning side to null (unless already changed)
            if ($lignecommandeproduit->getProduit() === $this) {
                $lignecommandeproduit->setProduit(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

}
