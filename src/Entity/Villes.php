<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VillesRepository")
 */
class Villes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ville_id;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $ville_departement;

    /**
     * @ORM\Column(type="string", length=46)
     */
    private $ville_nom_reel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville_code_postal;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $ville_code_commune;

    /**
     * @ORM\Column(type="integer")
     */
    private $ville_arrondissement;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $ville_canton;

    /**
     * @ORM\Column(type="float")
     */
    private $ville_longitude_deg;

    /**
     * @ORM\Column(type="float")
     */
    private $ville_latitude_deg;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleId(): ?int
    {
        return $this->ville_id;
    }

    public function setVilleId(int $ville_id): self
    {
        $this->ville_id = $ville_id;

        return $this;
    }

    public function getVilleDepartement(): ?string
    {
        return $this->ville_departement;
    }

    public function setVilleDepartement(string $ville_departement): self
    {
        $this->ville_departement = $ville_departement;

        return $this;
    }

    public function getVilleNomReel(): ?string
    {
        return $this->ville_nom_reel;
    }

    public function setVilleNomReel(string $ville_nom_reel): self
    {
        $this->ville_nom_reel = $ville_nom_reel;

        return $this;
    }

    public function getVilleCodePostal(): ?string
    {
        return $this->ville_code_postal;
    }

    public function setVilleCodePostal(string $ville_code_postal): self
    {
        $this->ville_code_postal = $ville_code_postal;

        return $this;
    }

    public function getVilleCodeCommune(): ?string
    {
        return $this->ville_code_commune;
    }

    public function setVilleCodeCommune(string $ville_code_commune): self
    {
        $this->ville_code_commune = $ville_code_commune;

        return $this;
    }

    public function getVilleArrondissement(): ?int
    {
        return $this->ville_arrondissement;
    }

    public function setVilleArrondissement(int $ville_arrondissement): self
    {
        $this->ville_arrondissement = $ville_arrondissement;

        return $this;
    }

    public function getVilleCanton(): ?string
    {
        return $this->ville_canton;
    }

    public function setVilleCanton(string $ville_canton): self
    {
        $this->ville_canton = $ville_canton;

        return $this;
    }

    public function getVilleLongitudeDeg(): ?float
    {
        return $this->ville_longitude_deg;
    }

    public function setVilleLongitudeDeg(float $ville_longitude_deg): self
    {
        $this->ville_longitude_deg = $ville_longitude_deg;

        return $this;
    }

    public function getVilleLatitudeDeg(): ?float
    {
        return $this->ville_latitude_deg;
    }

    public function setVilleLatitudeDeg(float $ville_latitude_deg): self
    {
        $this->ville_latitude_deg = $ville_latitude_deg;

        return $this;
    }
}
