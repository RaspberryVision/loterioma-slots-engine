<?php

namespace App\Entity;

use App\Repository\GeneratorConfigRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GeneratorConfigRepository::class)
 */
class GeneratorConfig
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $seed;

    /**
     * @ORM\Column(type="integer")
     */
    private $min;

    /**
     * @ORM\Column(type="integer")
     */
    private $max;

    /**
     * @ORM\Column(type="array")
     */
    private $format = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeed(): ?int
    {
        return $this->seed;
    }

    public function setSeed(int $seed): self
    {
        $this->seed = $seed;

        return $this;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function getFormat(): ?array
    {
        return $this->format;
    }

    public function setFormat(array $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function dto()
    {
        return new \App\DTO\GeneratorConfig($this->min, $this->max, $this->format, $this->seed);
    }
}
