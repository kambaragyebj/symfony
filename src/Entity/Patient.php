<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
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
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="patient")
     */
    private $doctor;

    public function __construct()
    {
        $this->doctor = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getDoctor(): Collection
    {
        return $this->doctor;
    }

    public function addDoctor(Video $doctor): self
    {
        if (!$this->doctor->contains($doctor)) {
            $this->doctor[] = $doctor;
            $doctor->setPatient($this);
        }

        return $this;
    }

    public function removeDoctor(Video $doctor): self
    {
        if ($this->doctor->contains($doctor)) {
            $this->doctor->removeElement($doctor);
            // set the owning side to null (unless already changed)
            if ($doctor->getPatient() === $this) {
                $doctor->setPatient(null);
            }
        }

        return $this;
    }
}
