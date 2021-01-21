<?php

namespace App\Entity;

use App\Repository\ResultStateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResultStateRepository::class)
 */
class ResultState
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $matrix = [];

    /**
     * @ORM\ManyToMany(targetEntity=SlotsCombination::class)
     */
    private $wonCombinations;

    public function __construct(?array $matrix = [])
    {
        $this->matrix = $matrix;
        $this->wonCombinations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatrix(): ?array
    {
        return $this->matrix;
    }

    public function setMatrix(?array $matrix): self
    {
        $this->matrix = $matrix;

        return $this;
    }

    /**
     * Get the value of a specific matrix cell.
     * @param int $x
     * @param int $y
     * @return int
     */
    public function getValue(int $x, int $y): int
    {
        return $this->matrix[$x][$y] ?? -1;
    }

    /**
     * @return Collection|SlotsCombination[]
     */
    public function getWonCombinations(): Collection
    {
        return $this->wonCombinations;
    }

    public function addWonCombination(SlotsCombination $wonCombination): self
    {
        if (!$this->wonCombinations->contains($wonCombination)) {
            $this->wonCombinations[] = $wonCombination;
        }

        return $this;
    }

    public function removeWonCombination(SlotsCombination $wonCombination): self
    {
        $this->wonCombinations->removeElement($wonCombination);

        return $this;
    }

    public function printCombinations()
    {
        return $this->wonCombinations->map(
            function (SlotsCombination $combination) {
                return [
                    'name' => $combination->getName(),
                    'fields' => $combination->getFields(),
                ];
            }
        )->toArray();
    }
}
