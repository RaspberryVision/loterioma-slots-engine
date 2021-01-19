<?php
/**
 * LoteriomaDiceEngine - application enabling the operation of gambling cubes.
 *
 * The application consists of a dice game engine based on a pseudo-randomity for which
 * the external RNG component is used. The application is only responsible for handling
 * the game logic and forwards its results to the Core component. Data used in the operation
 * of the application are downloaded from the DataStore component.
 *
 * See more: https://raspberryvision.github.io/loterioma-dice-engine/.
 *
 * DiceEngine - casino dice game server.
 * @see https://github.com/RaspberryVision/loterioma-dice-engine
 *
 * This code is part of the LoterioMa casino system.
 * @see https://github.com/RaspberryVision/loterioma
 *
 * Created by Rafal Malik.
 * 15:47 02.04.2020, Warsaw/Zabki - DELL
 */

namespace App\Controller;

use App\Engine\SlotsEngine;
use App\Entity\Round;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * The controller being the application access point for HTTP requests.
 * @category   Controller
 * @package    App\Controller
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  04.2020 Raspberry Vision
 * @Route("/base")
 */
class EndpointController extends AbstractController
{
    /**
     * @Route("/play", name="base_endpoint_play")
     * @param Request $request
     * @param GameRepository $gameRepository
     * @param DiceEngine $engine
     * @return JsonResponse
     */
    public function play(Request $request, GameRepository $gameRepository, SlotsEngine $engine): JsonResponse
    {
        $gameObject = $gameRepository->find($request->get('id', -1));

        if (!$gameObject) {
            // @todo response error
        }

        $gameRound = $engine->play($gameObject, json_decode($request->getContent(), true));

         $this->checkWinnings($gameRound);

        return $this->json(
            [
                'body' => $gameRound->printInfo(),
            ]
        );
    }

    public function checkWinnings(Round $round)
    {
        // Default round is lost.
        $round->setStatus(1);

        $matrix = $round->getResult()->getMatrix();

        foreach ($round->getGame()->getCombinations() as $combination) {

            $symbol = $matrix[$combination->getFields()[0][0]][$combination->getFields()[0][1]];
            foreach ($combination->getFields() as $key => $field) {

                if ($symbol == $matrix[$field[0]][$field[1]]) {

                } else {
                    continue;
                }


                if ($key == count($combination->getFields()) - 1) {
                    $round->setStatus(2);
                }
            }
        }

        return $round;
    }

    /**
     * @param ResultState $matrix
     * @param Bet $bet
     * @return bool
     */
    private function checkBet(ResultState $resultState, Bet $bet): bool
    {
        return $bet->getNumber() === $resultState->getValue(0, 0);
    }

}
