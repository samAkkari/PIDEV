<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
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
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $specialite;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="restaurants")
     */
    private $id_manager;

    /**
     * @ORM\OneToMany(targetEntity=Menu::class, mappedBy="id_restaurant")
     */
    private $id_menu;

    public function __construct()
    {
        $this->id_menu = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(?string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getIdManager(): ?utilisateur
    {
        return $this->id_manager;
    }

    public function setIdManager(?utilisateur $id_manager): self
    {
        $this->id_manager = $id_manager;

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getIdMenu(): Collection
    {
        return $this->id_menu;
    }

    public function addIdMenu(Menu $idMenu): self
    {
        if (!$this->id_menu->contains($idMenu)) {
            $this->id_menu[] = $idMenu;
            $idMenu->setIdRestaurant($this);
        }

        return $this;
    }

    public function removeIdMenu(Menu $idMenu): self
    {
        if ($this->id_menu->removeElement($idMenu)) {
            // set the owning side to null (unless already changed)
            if ($idMenu->getIdRestaurant() === $this) {
                $idMenu->setIdRestaurant(null);
            }
        }

        return $this;
    }


}
