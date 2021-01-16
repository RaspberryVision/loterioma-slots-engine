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

namespace App\DTO\Game;

use App\DTO\JsonInitializableInterface;

/**
 * Object for game play action params.
 * @category   Models
 * @package    App\Model\DTO
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
class GameRequest implements JsonInitializableInterface, GameRequestInterface
{
    public const REQUIRED_PROPERTIES = [
        'mode',
        'gameId',
        'client',
        'userId',
        'parameters',
    ];

    /**
     * @var int $gameId Unique game hash.
     */
    private int $gameId;

    /**
     * @var string $client Client app hash.
     */
    private string $client;

    /**
     * @var int $userId
     */
    private int $userId;

    /**
     * @var int $mode Specific game mode.
     */
    private int $mode;

    /**
     * @var array $parameters
     */
    private array $parameters;

    /**
     * GameRequest constructor.
     * @param string $jsonData
     */
    public function __construct(string $jsonData)
    {
        $this->setFromJson($jsonData);
    }

    /**
     * @return int
     */
    public function getGameId(): int
    {
        return $this->gameId;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->mode;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param int $gameId
     * @return GameRequest
     */
    public function setGameId(int $gameId): GameRequest
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * @param string $client
     * @return GameRequest
     */
    public function setClient(string $client): GameRequest
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param int $userId
     * @return GameRequest
     */
    public function setUserId(int $userId): GameRequest
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @param int $mode
     * @return GameRequest
     */
    public function setMode(int $mode): GameRequest
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @param array $parameters
     * @return GameRequest
     */
    public function setParameters(array $parameters): GameRequest
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Transform object to parameters used as HTTP request params.
     * @param string $json
     * @return bool|void
     */
    public function setFromJson(string $json)
    {
        $data = json_decode($json, true);

        if (!$data || !$this->checkRequiredProperties($data)) {
            throw new \LogicException('Invalid required property value!');
        }

        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Check that all required properties is set in request data.
     * @param array $data
     * @return bool
     */
    private function checkRequiredProperties(array $data): bool
    {
        foreach ($this::REQUIRED_PROPERTIES as $property) {
            if (!isset($data[$property])) {
                return false;
            }
        }

        return true;
    }
}