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
use App\Entity\GameSession;
use App\Entity\Round;
use App\NetworkHelper\Cashier\CashierHelper;
use App\Repository\GameRepository;
use App\Repository\GameSessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
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
 *
 * @Route("/session")
 */
class SessionController extends AbstractController
{

    /**
     * @var Request $request
     */
    private $request;

    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @var GameSessionRepository $sessionRepository
     */
    private $sessionRepository;

    /**
     * SessionController constructor.
     * @param Request $request
     * @param LoggerInterface $logger
     * @param EntityManagerInterface $entityManager
     * @param GameSessionRepository $sessionRepository
     */
    public function __construct(
        Request $request,
        LoggerInterface $logger,
        EntityManagerInterface $entityManager,
        GameSessionRepository $sessionRepository
    ) {
        $this->request = $request;
        $this->logger = $logger;
        $this->entityManager = $entityManager;
        $this->sessionRepository = $sessionRepository;
    }

    /**
     * @Route("/create", name="session_create", methods={"POST"})
     *
     * @param GameRepository $gameRepository
     * @return JsonResponse
     */
    public function create(GameRepository $gameRepository)
    {
        $data = json_decode($this->request->getContent(), true);
        $gameObject = $gameRepository->find($data['gameId']);

        $session = new GameSession();
        $session->setValue($data['amount'])
            ->setToken(uniqid())
            ->setGame($gameObject)
            ->setCreatedAt(new \DateTime());

        $this->entityManager->persist($session);
        $this->entityManager->flush();

        return $this->json(
            [
                'status' => 0,
                'sessionId' => $session->getToken(),
                'amount' => $session->getValue(),
            ]
        );
    }

    /**
     * @Route("/read", name="session_read", methods={"GET"})
     */
    public function read()
    {
        $data = json_decode($this->request->getContent(), true);

        $session = $this->entityManager->getRepository(GameSession::class)->findOneBy(
            [
                'token' => $data['sessionId'],
            ]
        );
    }

    /**
     * @Route("/update", name="session_update", methods={"PUT"})
     */
    public function update()
    {
        $data = json_decode($this->request->getContent(), true);

        $session = $this->entityManager->getRepository(GameSession::class)->findOneBy(
            [
                'token' => $data['sessionId'],
            ]
        );

        $session->setValue($session->getValue() + $data['amount']);
    }

    /**
     * @Route("/delete", name="session_delete", methods={"DELETE"})
     */
    public function delete()
    {
        $data = json_decode($this->request->getContent(), true);

        $session = $this->entityManager->getRepository(GameSession::class)->findOneBy(
            [
                'token' => $data['sessionId'],
            ]
        );

        $session->setValue($session->getValue() + $data['amount']);
    }

}