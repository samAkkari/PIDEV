<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_commande;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $remise;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;


    /**
     * @ORM\OneToOne(targetEntity=Livraison::class, cascade={"persist", "remove"})
     */
    private $id_livraison;


    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="commandes")
     */
    private $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity=LigneCommandeMenu::class, mappedBy="commande")
     */
    private $lignecommandemenus;

    /**
     * @ORM\OneToMany(targetEntity=LigneCommandeProduit::class, mappedBy="commande")
     */
    private $lignecommandeproduits;

    public function __construct()
    {
        $this->lignecommandemenus = new ArrayCollection();
        $this->lignecommandeproduits = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(?\DateTimeInterface $date_commande): self
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getRemise(): ?string
    {
        return $this->remise;
    }

    public function setRemise(?string $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getIdLivraison(): ?livraison
    {
        return $this->id_livraison;
    }

    public function setIdLivraison(?livraison $id_livraison): self
    {
        $this->id_livraison = $id_livraison;

        return $this;
    }

    public function getUtilisateur(): ?utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection|Lignecommandemenu[]
     */
    public function getLignecommandemenus(): Collection
    {
        return $this->lignecommandemenus;
    }

    public function addLignecommandemenu(Lignecommandemenu $lignecommandemenu): self
    {
        if (!$this->lignecommandemenus->contains($lignecommandemenu)) {
            $this->lignecommandemenus[] = $lignecommandemenu;
            $lignecommandemenu->setCommande($this);
        }

        return $this;
    }

    public function removeLignecommandemenu(Lignecommandemenu $lignecommandemenu): self
    {
        if ($this->lignecommandemenus->removeElement($lignecommandemenu)) {
            // set the owning side to null (unless already changed)
            if ($lignecommandemenu->getCommande() === $this) {
                $lignecommandemenu->setCommande(null);
            }
        }

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
            $lignecommandeproduit->setCommande($this);
        }

        return $this;
    }

    public function removeLignecommandeproduit(Lignecommandeproduit $lignecommandeproduit): self
    {
        if ($this->lignecommandeproduits->removeElement($lignecommandeproduit)) {
            // set the owning side to null (unless already changed)
            if ($lignecommandeproduit->getCommande() === $this) {
                $lignecommandeproduit->setCommande(null);
            }
        }

        return $this;
    }
}
