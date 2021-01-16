<?php
/**
 * A container for the Random Number Generator configuration.
 *
 * ~
 *
 * @category   DTO
 * @package    App\Model\DTO
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\DTO;

class GeneratorConfig implements NormalizableBodyInterface
{
    /**
     * @var int
     */
    private $seed;

    /**
     * @var int
     */
    private $min;

    /**
     * @var int
     */
    private $max;

    /**
     * @var array
     */
    private $format;

    /**
     * Developer can to debug RNG by change this value to DEBUG.
     *
     * @var int
     */
    private $mode;

    /**
     * If DEBUG mode is enabled, we can to add parameters to RNG:
     * - response,
     *
     * @var array
     */
    private $devOptions;

    /**
     * RNGRequest constructor.
     * @param int $min
     * @param int $max
     * @param array $format
     * @param int $seed
     * @param int $mode
     * @param array $devOptions
     */
    public function __construct(
        int $min,
        int $max,
        array $format,
        int $seed = 0,
        int $mode = 0,
        array $devOptions = []
    )
    {
        $this->seed = $seed;
        $this->min = $min;
        $this->max = $max;
        $this->format = $format;
        $this->mode = $mode;
        $this->devOptions = $devOptions;
    }

    /**
     * @return int
     */
    public function getSeed(): int
    {
        return $this->seed;
    }

    /**
     * @param int $seed
     * @return GeneratorConfig
     */
    public function setSeed(int $seed): GeneratorConfig
    {
        $this->seed = $seed;
        return $this;
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @param int $min
     * @return GeneratorConfig
     */
    public function setMin(int $min): GeneratorConfig
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param int $max
     * @return GeneratorConfig
     */
    public function setMax(int $max): GeneratorConfig
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @return array
     */
    public function getFormat(): array
    {
        return $this->format;
    }

    /**
     * @param array $format
     * @return GeneratorConfig
     */
    public function setFormat(array $format): GeneratorConfig
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->mode;
    }

    /**
     * @param int $mode
     * @return GeneratorConfig
     */
    public function setMode(int $mode): GeneratorConfig
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return array
     */
    public function getDevOptions(): array
    {
        return $this->devOptions;
    }

    /**
     * @param array $devOptions
     * @return GeneratorConfig
     */
    public function setDevOptions(array $devOptions): GeneratorConfig
    {
        $this->devOptions = $devOptions;
        return $this;
    }

    /**
     * Transform object to parameters used as HTTP request params.
     * @return array
     */
    public function normalizeBody(): array
    {
        return [
            'min' => $this->getMin(),
            'max' => $this->getMax(),
            'format' => $this->getFormat(),
            'seed' => $this->getSeed(),
            'mode' => $this->getMode(),
            'devOptions' => $this->getDevOptions()
        ];
    }
}