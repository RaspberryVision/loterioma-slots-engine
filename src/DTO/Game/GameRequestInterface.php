<?php

/**
 * GameRequestInterface - @todo One sentence about that.
 *
 * @todo add file description
 *
 * See more: @todo add documentation link
 *
 * Engine - casino game server.
 * @see https://github.com/RaspberryVision/loterioma-engine
 *
 * This code is part of the LoterioMa casino system.
 * @see https://github.com/RaspberryVision/loterioma
 *
 * Created by Rafal Malik.
 * 21:13 22.03.2020, Warsaw/Zabki - DELL
 */

namespace App\DTO\Game;

/**
 * @todo Short description
 */
interface GameRequestInterface
{
    /**
     *
     * @return int
     * @todo Short description
     */
    public function getGameId(): int;

    /**
     * Get info about connection client (webapp, mobile or whatever)
     * @return string
     * @todo Short description
     */
    public function getClient(): string;

    /**
     *
     * @return int
     * @todo Short description
     */
    public function getUserId(): int;

    /**
     * @return int
     * @todo Short description
     */
    public function getMode(): int;

    /**
     * Parameters for specific round, for example player bets or bet amount.
     * @return array
     * @todo Short description
     */
    public function getParameters(): array;
}