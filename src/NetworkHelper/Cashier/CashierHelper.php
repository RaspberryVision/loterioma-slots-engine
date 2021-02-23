<?php
/**
 * Curl helper to RandomNumberGenerator.
 *
 * An auxiliary class providing methods for performing API queries to the loterioma-rng component.
 *
 * @category   Helpers
 * @package    App\NetworkHelper\RNG
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\NetworkHelper\Cashier;

use App\DTO\Network\NetworkRequest;
use App\DTO\Network\NetworkResponseInterface;
use App\NetworkHelper\AbstractNetworkHelper;

/**
 * Helper providing communication with a random number generator.
 * @category   NetworkHelper
 * @package    App\NetworkHelper\RNG
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
class CashierHelper extends AbstractNetworkHelper
{
    /**
     * RNGHelper constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'loterioma_cashier_helper',
            'http://loterioma_cashier',
            80
        );
    }

    /**
     * Method returns
     * @return NetworkResponseInterface
     */
    public function payIn(array $params): NetworkResponseInterface
    {
        $networkRequest = new NetworkRequest(
            '/pay-in',
            'POST',
            'loterioma_cashier_hash',
            json_encode($params)
        );

        return $this->makeRequest($networkRequest);
    }
}