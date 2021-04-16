<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SessionControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/session/create', [], [], [], json_encode([
            'gameId' => 1,
            'amount' => 100,
            'suid' => '870ff240-6c4a-4760-ae22-ac08feb40bd5'
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $response = json_decode($client->getResponse()->getContent(), true);
    }

    public function testRead()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/session/create', [], [], [], json_encode([
            'gameId' => 1,
            'amount' => 100,
            'suid' => '870ff240-6c4a-4760-ae22-ac08feb40bd5'
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
