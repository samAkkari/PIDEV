<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
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
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, inversedBy="types")
     */
    private $id_ingredients;

    public function __construct()
    {
        $this->id_ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|ingredient[]
     */
    public function getIdIngredients(): Collection
    {
        return $this->id_ingredients;
    }

    public function addIdIngredient(ingredient $idIngredient): self
    {
        if (!$this->id_ingredients->contains($idIngredient)) {
            $this->id_ingredients[] = $idIngredient;
        }

        return $this;
    }

    public function removeIdIngredient(ingredient $idIngredient): self
    {
        $this->id_ingredients->removeElement($idIngredient);

        return $this;
    }


}
