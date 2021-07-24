<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository", repositoryClass=MenuRepository::class)
 */
class Menu
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $details;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=Offre::class, mappedBy="menu")
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="menu")
     */
    private $restaurant;

    /**
     * @ORM\OneToMany(targetEntity=LigneCommandeMenu::class, mappedBy="menu")
     */
    private $lignecommandemenus;


    public function __construct()
    {
        $this->offer = new ArrayCollection();
        $this->lignecommandemenus = new ArrayCollection();

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

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

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

    public function getOffer(): Collection
    {
        return $this->offer;
    }

    public function addOffre(offre $offre): self
    {
        if (!$this->offer->contains($offre)) {
            $this->offer[] = $offre;
            $offre->setMenu($this);
        }

        return $this;
    }

    public function removeOffre(offre $offre): self
    {
        if ($this->offer->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getMenu() === $this) {
                $offre->setMenu(null);
            }
        }

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * @return Collection|Lignecommandemenu[]
     */
    public function getLignecommandemenus(): Collection
    {
        return $this->lignecommandemenus;
    }

    public function addlignecommandemenus(Lignecommandemenu $lignecommandemenus): self
    {
        if (!$this->lignecommandemenus->contains($lignecommandemenus)) {
            $this->lignecommandemenus[] = $lignecommandemenus;
            $lignecommandemenus->setMenu($this);
        }

        return $this;
    }

    public function removeLignecommandemenus(Lignecommandemenu $lignecommandemenus): self
    {
        if ($this->commande->removeElement($lignecommandemenus)) {
            // set the owning side to null (unless already changed)
            if ($lignecommandemenus->getMenu() === $this) {
                $lignecommandemenus->setMenu(null);
            }
        }

        return $this;
    }

}
