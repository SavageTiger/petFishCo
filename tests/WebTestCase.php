<?php

namespace SvenH\PetFishCo\Tests;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\HttpFoundation\JsonResponse;

class WebTestCase extends BaseWebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $this->client = static::createClient();

        $container     = $this->client->getContainer();
        $objectManager = $container->get('doctrine')->getManager();

        $purger = new ORMPurger($objectManager);
        $purger->purge();

        $fixtures = [
            $container->get('petfishco.fixtures.restrictions'),
            $container->get('petfishco.fixtures.aquarium'),
            $container->get('petfishco.fixtures.fish'),
            $container->get('petfishco.fixtures.mutations'),
        ];

        foreach ($fixtures as $fixtureService) {
            $fixtureService->load($objectManager);
        }

        // Reset entity states
        $doctrine = $container->get('doctrine');
        $doctrine->getManager()->getConnection()->close();
        $doctrine->getManager()->clear();
    }

    protected function queryApi($route, $data = [], $method = 'GET')
    {
        $this->client->xmlHttpRequest(
            $method, $route, [], [], [], json_encode($data)
        );

        /** @var JsonResponse $response */
        $response = $this->client->getResponse();

        $this->assertInstanceOf(JsonResponse::class, $response);

        return json_decode($response->getContent(), true);
    }
}

