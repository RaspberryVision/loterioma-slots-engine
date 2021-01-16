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

class NetworkRequest implements NetworkRequestInterface
{
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $body;

    /**
     * @var string
     */
    private $componentHash;

    /**
     * NetworkRequest constructor.
     * @param string $endpoint
     * @param string $method
     * @param string $componentHash
     * @param array|string|object $body
     */
    public function __construct(string $endpoint, string $method, string $componentHash, $body)
    {
        $this->endpoint = $endpoint;
        $this->method = $method;
        $this->componentHash = $componentHash;
        $this->body = $body;
    }

    /**
     * Prepare request params to send.
     *
     * @return array|object|string
     */
    public function getRequestParams()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getComponentHash(): string
    {
        return $this->componentHash;
    }

    /**
     * Get the method to be followed by the request.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}