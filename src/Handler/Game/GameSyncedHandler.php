<?php


namespace App\Handler\Game;

use App\Entity\Game;
use App\Entity\GeneratorConfig;
use App\Message\Game\GameSynced;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GameSyncedHandler implements MessageHandlerInterface
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

    public function __invoke(GameSynced $message)
    {
        $object = json_decode($message->getContent());

        $game = $this->entityManager->getRepository(Game::class)->find($object->id);

        if (!$game) {
            $game = new Game();
            $generatorConfig = new GeneratorConfig();
            $game->setGeneratorConfig($generatorConfig);
        }
        $game->setName($object->name)
            ->setDescription($object->description)
            ->setType($object->type);

        $game->getGeneratorConfig()->setMin($object->generatorConfig->min)
            ->setMax($object->generatorConfig->max)
            ->setFormat($object->generatorConfig->format)
            ->setSeed($object->generatorConfig->seed);

        $this->entityManager->persist($game);
        $this->entityManager->flush();
    }
}