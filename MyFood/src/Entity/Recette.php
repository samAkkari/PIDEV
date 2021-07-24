<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_publication;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $details;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, inversedBy="recettes")
     */
    private $id_ingredient;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="recette")
     */
    private $id_commentaire;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="recette")
     */
    private $id_avis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrLike;

    public function __construct()
    {
        $this->id_ingredient = new ArrayCollection();
        $this->id_commentaire = new ArrayCollection();
        $this->id_avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }

    public function setDatePublication(?\DateTimeInterface $date_publication): self
    {
        $this->date_publication = $date_publication;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    /**
     * @return Collection|ingredient[]
     */
    public function getIdIngredient(): Collection
    {
        return $this->id_ingredient;
    }

    public function addIdIngredient(ingredient $idIngredient): self
    {
        if (!$this->id_ingredient->contains($idIngredient)) {
            $this->id_ingredient[] = $idIngredient;
        }

        return $this;
    }

    public function removeIdIngredient(ingredient $idIngredient): self
    {
        $this->id_ingredient->removeElement($idIngredient);

        return $this;
    }

    /**
     * @return Collection|commentaire[]
     */
    public function getIdCommentaire(): Collection
    {
        return $this->id_commentaire;
    }

    public function addIdCommentaire(commentaire $idCommentaire): self
    {
        if (!$this->id_commentaire->contains($idCommentaire)) {
            $this->id_commentaire[] = $idCommentaire;
            $idCommentaire->setRecette($this);
        }

        return $this;
    }

    public function removeIdCommentaire(commentaire $idCommentaire): self
    {
        if ($this->id_commentaire->removeElement($idCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($idCommentaire->getRecette() === $this) {
                $idCommentaire->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|avis[]
     */
    public function getIdAvis(): Collection
    {
        return $this->id_avis;
    }

    public function addIdAvi(avis $idAvi): self
    {
        if (!$this->id_avis->contains($idAvi)) {
            $this->id_avis[] = $idAvi;
            $idAvi->setRecette($this);
        }

        return $this;
    }

    public function removeIdAvi(avis $idAvi): self
    {
        if ($this->id_avis->removeElement($idAvi)) {
            // set the owning side to null (unless already changed)
            if ($idAvi->getRecette() === $this) {
                $idAvi->setRecette(null);
            }
        }

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

    public function getNbrLike(): ?int
    {
        return $this->nbrLike;
    }

    public function setNbrLike(int $nbrLike): self
    {
        $this->nbrLike = $nbrLike;

        return $this;
    }
}
