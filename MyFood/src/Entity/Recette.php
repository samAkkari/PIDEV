<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;


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
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $datePublication;

    /**
     * @Groups("DetailsRecette")
     * @MaxDepth(2)
     * @ORM\OneToMany(targetEntity=DetailsRecette::class, mappedBy="recette")
     */
    private $detailsRecettes;

    public function __construct()
    {
        $this->detailsRecettes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDatePublication(): ?string
    {
        return $this->datePublication;
    }

    public function setDatePublication(string $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * @return Collection|DetailsRecette[]
     */
    public function getDetailsRecettes(): Collection
    {
        return $this->detailsRecettes;
    }

    public function addDetailsRecette(DetailsRecette $detailsRecette): self
    {
        if (!$this->detailsRecettes->contains($detailsRecette)) {
            $this->detailsRecettes[] = $detailsRecette;
            $detailsRecette->setRecette($this);
        }

        return $this;
    }

    public function removeDetailsRecette(DetailsRecette $detailsRecette): self
    {
        if ($this->detailsRecettes->removeElement($detailsRecette)) {
            // set the owning side to null (unless already changed)
            if ($detailsRecette->getRecette() === $this) {
                $detailsRecette->setRecette(null);
            }
        }

        return $this;
    }
}
