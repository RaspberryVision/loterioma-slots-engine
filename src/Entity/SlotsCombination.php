<?php

namespace App\Entity;

use App\Repository\SlotsCombinationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SlotsCombinationRepository::class)
 */
class SlotsCombination
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
    private $name;

    /**
     * @ORM\Column(type="array")
     */
    private $fields = [];

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="combinations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * SlotsCombination constructor.
     * @param string|null $name
     * @param array|null $fields
     */
    public function __construct(?string $name = '', ?array $fields = [])
    {
        $this->name = $name;
        $this->fields = $fields;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFields(): ?array
    {
        return $this->fields;
    }

    public function setFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }
}
