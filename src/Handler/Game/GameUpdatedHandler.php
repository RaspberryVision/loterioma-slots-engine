<?php


namespace App\Handler\Game;


use App\Entity\Game;
use App\Message\Game\GameCreated;
use App\Message\Game\GameUpdated;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GameUpdatedHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * UserRegistrationHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(GameUpdated $message)
    {
        $object = json_decode($message->getContent());

        $game = $this->entityManager->getRepository(Game::class)->find($object->id);
        $game->setName($object->name)
            ->setDescription($object->description)
            ->setType($object->type);

        $this->entityManager->persist($game);
        $this->entityManager->flush();
    }
}