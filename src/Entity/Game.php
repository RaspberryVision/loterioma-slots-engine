<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    public const TYPE_DICE = 1;
    public const TYPE_SLOTS = 2;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity=GeneratorConfig::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $generatorConfig;

    /**
     * @ORM\OneToMany(targetEntity=GameSymbol::class, mappedBy="game", cascade={"PERSIST"})
     */
    private $symbols;

    /**
     * @ORM\OneToMany(targetEntity=SlotsCombination::class, mappedBy="game", cascade={"PERSIST"})
     */
    private $combinations;

    /**
     * @ORM\OneToMany(targetEntity=Round::class, mappedBy="game")
     */
    private $rounds;

    public function __construct()
    {
        $this->symbols = new ArrayCollection();
        $this->combinations = new ArrayCollection();
        $this->rounds = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getGeneratorConfig(): ?GeneratorConfig
    {
        return $this->generatorConfig;
    }

    public function setGeneratorConfig(GeneratorConfig $generatorConfig): self
    {
        $this->generatorConfig = $generatorConfig;

        return $this;
    }

    public function dto()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'generatorConfig' => [
                'min' => $this->getGeneratorConfig()->getMin(),
                'max' => $this->getGeneratorConfig()->getMax(),
                'seed' => $this->getGeneratorConfig()->getSeed(),
                'format' => $this->getGeneratorConfig()->getFormat()
            ]
        ];
    }

    /**
     * @return Collection|GameSymbol[]
     */
    public function getSymbols(): Collection
    {
        return $this->symbols;
    }

    public function addSymbol(GameSymbol $symbol): self
    {
        if (!$this->symbols->contains($symbol)) {
            $this->symbols[] = $symbol;
            $symbol->setGame($this);
        }

        return $this;
    }

    public function removeSymbol(GameSymbol $symbol): self
    {
        if ($this->symbols->removeElement($symbol)) {
            // set the owning side to null (unless already changed)
            if ($symbol->getGame() === $this) {
                $symbol->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SlotsCombination[]
     */
    public function getCombinations(): Collection
    {
        return $this->combinations;
    }

    public function addCombination(SlotsCombination $combination): self
    {
        if (!$this->combinations->contains($combination)) {
            $this->combinations[] = $combination;
            $combination->setGame($this);
        }

        return $this;
    }

    public function removeCombination(SlotsCombination $combination): self
    {
        if ($this->combinations->removeElement($combination)) {
            // set the owning side to null (unless already changed)
            if ($combination->getGame() === $this) {
                $combination->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Round[]
     */
    public function getRounds(): Collection
    {
        return $this->rounds;
    }

    public function addRound(Round $round): self
    {
        if (!$this->rounds->contains($round)) {
            $this->rounds[] = $round;
            $round->setGame($this);
        }

        return $this;
    }

    public function removeRound(Round $round): self
    {
        if ($this->rounds->removeElement($round)) {
            // set the owning side to null (unless already changed)
            if ($round->getGame() === $this) {
                $round->setGame(null);
            }
        }

        return $this;
    }
}
