<?php
/**
 * Curl helper to core requests.
 *
 * Helper enabling communication with the casino nucleus, it performs all operations
 * on the network after the end of the game.
 *
 * @category   Helpers
 * @package    App\NetworkHelper\Core
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\NetworkHelper\Core;

use App\Model\DTO\Network\NetworkRequestInterface;
use App\Model\DTO\Network\NetworkResponseInterface;
use App\NetworkHelper\AbstractNetworkHelper;

/**
 * A class that provides access methods to casino action.
 * @category   NetworkHelper
 * @package    App\NetworkHelper\Core
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
class CoreHelper extends AbstractNetworkHelper
{
    /**
     * RNGHelper constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'loterioma_core_helper',
            'http://loterioma_core',
            80
        );
    }

    /**
     * Method returns
     * @param NetworkRequestInterface $networkRequest
     * @return NetworkResponseInterface
     */
    public function processRound(NetworkRequestInterface $networkRequest): NetworkResponseInterface
    {
        return $this->makeRequest($networkRequest);
    }
}