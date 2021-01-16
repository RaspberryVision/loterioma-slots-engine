<?php


namespace App\Handler\Game;


use App\Entity\Game;
use App\Entity\GeneratorConfig;
use App\Message\Game\GameCreated;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GameCreatedHandler implements MessageHandlerInterface
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

    public function __invoke(GameCreated $message)
    {
        $object = json_decode($message->getContent());

        $game = new Game();
        $game->setName($object->name)
            ->setDescription($object->description)
            ->setType($object->type);

        $generatorConfig = new GeneratorConfig();
        $generatorConfig->setMin($object->generatorConfig->min)
            ->setMax($object->generatorConfig->max)
            ->setFormat($object->generatorConfig->format)
            ->setSeed($object->generatorConfig->seed);

        $game->setGeneratorConfig($generatorConfig);

        $this->entityManager->persist($game);
        $this->entityManager->flush();
    }
}