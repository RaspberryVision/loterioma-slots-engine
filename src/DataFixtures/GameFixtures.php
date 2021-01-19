<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\GameSymbol;
use App\Entity\GeneratorConfig;
use App\Entity\SlotsCombination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GameFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $item) {
            $game = new Game();
            $game->setName($item['name'])
                ->setDescription($item['description'])
                ->setType($item['type']);

            $config = new GeneratorConfig();
            $config->setSeed($item['generator']['seed'])
                ->setMin($item['generator']['min'])
                ->setMax($item['generator']['max'])
                ->setFormat($item['generator']['format']);
            $game->setGeneratorConfig($config);

            if (isset($item['symbols'])) {
                foreach ($item['symbols'] as $symbol) {
                    $game->addSymbol(new GameSymbol($symbol['name'], $symbol['rate'], $symbol['image']));
                }
            }

            if (isset($item['combinations'])) {
                foreach ($item['combinations'] as $combination) {
                    $game->addCombination(new SlotsCombination($combination['name'], $combination['fields']));
                }
            }

            $manager->persist($game);
        }

        $manager->flush();
    }

    /**
     * @return array[]
     * @todo Extract this to json dictionary.
     *
     */
    private function getData()
    {
        return [
            [
                'name' => 'Simple Dice',
                'description' => 'Simple dice game simulator',
                'type' => Game::TYPE_DICE,
                'generator' => [
                    'seed' => 1,
                    'min' => 1,
                    'max' => 10,
                    'format' => [[1]],
                ],
            ],
            [
                'name' => 'Tiny Dice',
                'description' => 'Tiny dice game simulator',
                'type' => Game::TYPE_DICE,
                'generator' => [
                    'seed' => 1,
                    'min' => 1,
                    'max' => 4,
                    'format' => [[1]],
                ],
            ],
            [
                'name' => 'Large Dice',
                'description' => 'Large dice game simulator',
                'type' => Game::TYPE_DICE,
                'generator' => [
                    'seed' => 1,
                    'min' => 1,
                    'max' => 100,
                    'format' => [[1]],
                ],
            ],
            [
                'name' => 'Single Line Slots',
                'description' => 'Single line slots game',
                'type' => Game::TYPE_SLOTS,
                'generator' => [
                    'seed' => 1,
                    'min' => 1,
                    'max' => 6,
                    'format' => [[1, 1, 1, 1]],
                ],
                'symbols' => [
                    [
                        'name' => 'As',
                        'rate' => 100,
                        'image' => 'A',
                    ],
                    [
                        'name' => 'Krol',
                        'rate' => 50,
                        'image' => 'K',
                    ],
                    [
                        'name' => 'Dama',
                        'rate' => 25,
                        'image' => 'D',
                    ],
                    [
                        'name' => 'Joker',
                        'rate' => 10,
                        'image' => 'J',
                    ],
                    [
                        'name' => 'Mars',
                        'rate' => 5,
                        'image' => 'M',
                    ],
                ],
                'combinations' => [
                    [
                        'name' => 'Line1',
                        'fields' => [
                            [0, 0],
                            [0, 1],
                            [0, 2],
                        ]
                    ]
                ],
            ],
            [
                'name' => 'Classic Slots 3x3',
                'description' => 'Classic slots game with 3x3 fields',
                'type' => Game::TYPE_SLOTS,
                'generator' => [
                    'seed' => 1,
                    'min' => 1,
                    'max' => 15,
                    'format' => [
                        [1, 1, 1],
                        [1, 1, 1],
                        [1, 1, 1],
                    ],
                ],
            ],
            [
                'name' => 'Crazy Slots',
                'description' => 'Crazy slots game with irregular matrix format',
                'type' => Game::TYPE_SLOTS,
                'generator' => [
                    'seed' => 1,
                    'min' => 1,
                    'max' => 15,
                    'format' => [
                        [1, -1, 1, -1, 1],
                        [1, 1, 1, 1, 1],
                        [1, -1, 1, -1, 1],
                    ],
                ],
            ],
        ];
    }
}
