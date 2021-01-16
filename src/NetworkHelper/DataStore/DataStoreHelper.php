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

namespace App\NetworkHelper\DataStore;

use App\DTO\Network\NetworkRequest;
use App\DTO\Network\NetworkRequestInterface;
use App\DTO\Network\NetworkResponseInterface;
use App\NetworkHelper\AbstractNetworkHelper;
use App\NetworkHelper\ModelBuilder;

/**
 * A class that provides access methods to casino action.
 * @category   NetworkHelper
 * @package    App\NetworkHelper\Core
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
class DataStoreHelper extends AbstractNetworkHelper
{
    /** @var ModelBuilder $modelBuilder */
    private $modelBuilder;

    /**
     * DataStoreHelper constructor.
     */
    public function __construct()
    {
        $this->modelBuilder = new ModelBuilder();
        parent::__construct(
            'loterioma_datastore_helper',
            'http://api',
            80
        );
    }

    /**
     * The method used to retrieve the user's object based on the criteria provided.
     * @param NetworkRequestInterface $networkRequest
     * @return NetworkResponseInterface
     */
    public function fetchUser(NetworkRequestInterface $networkRequest): NetworkResponseInterface
    {
        return $this->makeRequest($networkRequest);
    }

//    /**
//     * The method that sends a request to save the object of the created game.
//     * !!! To play, you must still activate the game object.
//     * @param int $id
//     * @return NetworkResponseInterface
//     */
//    public function fetchGame(int $id): NetworkResponseInterface
//    {
//        return $this->makeRequest(
//            new NetworkRequest(
//                '/games/'.$id,
//                'GET',
//                'sadasdas',
//                []
//            )
//        );
//    }

    /**
     * The method that sends a request to save the object of the created game.
     * !!! To play, you must still activate the game object.
     * @param int|null $id
     * @return DiceGame|null
     */
    public function fetchGame(int $id): ?GameInterface
    {
        $response = $this->makeRequest(new NetworkRequest(
            '/games/' . $id,
            'GET',
            'sadasdas',
            []
        ));

        if ($response->getBody()) {
            return $this->modelBuilder->convert(DiceGame::class, $response->getBody());
        }

        return null;
    }
}