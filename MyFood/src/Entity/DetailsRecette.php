<?php

namespace App\Entity;

use App\Repository\DetailsRecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DetailsRecetteRepository::class)
 */
class DetailsRecette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @Groups("Recette")
     * @MaxDepth(2)
     * @ORM\ManyToOne(targetEntity=Recette::class, inversedBy="detailsRecettes")
     */
    private $recette;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class, inversedBy="detailsRecettes")
     */
    private $Ing1;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class, inversedBy="Ing3")
     */
    private $Ing2;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class)
     */
    private $Ing3;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class)
     */
    private $Ing4;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class)
     */
    private $Ing5;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class)
     */
    private $Ing6;


    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class)
     */
    private $Ing7;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class)
     */
    private $Ing8;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class)
     */
    private $Ing9;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredients::class)
     */
    private $Ing10;


    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): self
    {
        $this->recette = $recette;

        return $this;
    }

    public function getIng1(): ?Ingredients
    {
        return $this->Ing1;
    }

    public function setIng1(?Ingredients $Ing1): self
    {
        $this->Ing1 = $Ing1;

        return $this;
    }

    public function getIng2(): ?Ingredients
    {
        return $this->Ing2;
    }

    public function setIng2(?Ingredients $Ing2): self
    {
        $this->Ing2 = $Ing2;

        return $this;
    }

    public function getIng3(): ?Ingredients
    {
        return $this->Ing3;
    }

    public function setIng3(?Ingredients $Ing3): self
    {
        $this->Ing3 = $Ing3;

        return $this;
    }

    public function getIng4(): ?Ingredients
    {
        return $this->Ing4;
    }

    public function setIng4(?Ingredients $Ing4): self
    {
        $this->Ing4 = $Ing4;

        return $this;
    }

    public function getIng5(): ?Ingredients
    {
        return $this->Ing5;
    }

    public function setIng5(?Ingredients $Ing5): self
    {
        $this->Ing5 = $Ing5;

        return $this;
    }

    public function getIng6(): ?Ingredients
    {
        return $this->Ing6;
    }

    public function setIng6(?Ingredients $Ing6): self
    {
        $this->Ing6 = $Ing6;

        return $this;
    }


    public function getIng7(): ?Ingredients
    {
        return $this->Ing7;
    }

    public function setIng7(?Ingredients $Ing7): self
    {
        $this->Ing7 = $Ing7;

        return $this;
    }

    public function getIng8(): ?Ingredients
    {
        return $this->Ing8;
    }

    public function setIng8(?Ingredients $Ing8): self
    {
        $this->Ing8 = $Ing8;

        return $this;
    }

    public function getIng9(): ?Ingredients
    {
        return $this->Ing9;
    }

    public function setIng9(?Ingredients $Ing9): self
    {
        $this->Ing9 = $Ing9;

        return $this;
    }

    public function getIng10(): ?Ingredients
    {
        return $this->Ing10;
    }

    public function setIng10(?Ingredients $Ing10): self
    {
        $this->Ing10 = $Ing10;

        return $this;
    }



}
