<?php
/**
 * Container for the response object from network component.
 *
 * ~
 *
 * @category   DTO
 * @package    App\Model\DTO
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\DTO\Network;

class NetworkResponse implements NetworkResponseInterface
{
    /**
     * @var array|null
     */
    private $body;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var string
     */
    private $requestHash;

    /**
     * RNGResponse constructor.
     * @param string|null $body
     * @param int $statusCode
     * @param string $requestHash
     */
    public function __construct(?string $body, int $statusCode, string $requestHash)
    {
        $this->body = json_decode($body, true);
        $this->statusCode = $statusCode;
        $this->requestHash = $requestHash;
    }

    /**
     * @return array|null
     */
    public function getBody(): ?array
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getRequestHash(): string
    {
        return $this->requestHash;
    }
}