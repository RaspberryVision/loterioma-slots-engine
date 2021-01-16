<?php

/**
 * JsonInitializableInterface - @todo One sentence about that.
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
 * 21:08 22.03.2020, Warsaw/Zabki - DELL
 */

namespace App\DTO;

/**
 * An interface that specifies the class's ability to initialize its properties with json objects
 */
interface JsonInitializableInterface
{
    public function setFromJson(string $jsonData);
}