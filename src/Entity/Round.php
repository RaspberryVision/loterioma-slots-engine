<?php

namespace App\Entity;

use App\Repository\RoundRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoundRepository::class)
 */
class Round
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\Column(type="float")
     */
    private $balance;

    /**
     * @ORM\OneToOne(targetEntity=ResultState::class, cascade={"persist", "remove"})
     */
    private $result;

    /**
     * @ORM\OneToOne(targetEntity=Game::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    public function __construct(Game $game, int $bet, ResultState $resultState = null)
    {
        $this->game = $game;
        $this->result = $resultState;
        $this->status = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getResult(): ?ResultState
    {
        return $this->result;
    }

    public function setResult(?ResultState $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function printInfo(): array
    {
        return [
            'result' => $this->result->getMatrix(),
            'status' => $this->status,
            'wonCombinations' => $this->result->printCombinations(),
            'sum' => count( $this->result->printCombinations()),
        ];
    }
}
