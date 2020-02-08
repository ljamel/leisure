<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorysRepository")
 */
class Categorys
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Activitys", mappedBy="categorys")
     */
    private $activitys;

    public function __construct()
    {
        $this->activitys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Activitys[]
     */
    public function getActivitys(): Collection
    {
        return $this->activitys;
    }

    public function addActivity(Activitys $activity): self
    {
        if (!$this->activitys->contains($activity)) {
            $this->activitys[] = $activity;
            $activity->addCategory($this);
        }

        return $this;
    }

    public function removeActivity(Activitys $activity): self
    {
        if ($this->activitys->contains($activity)) {
            $this->activitys->removeElement($activity);
            $activity->removeCategory($this);
        }

        return $this;
    }
}
