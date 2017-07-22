<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/articles');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client = static::createClient();
        $crawler = $client->request('GET', '/articles?limit=5&order=desc&page=2');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client = static::createClient();
        $crawler = $client->request('GET', '/articles?brand=Apple');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testProduct()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/articles/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testProductDetails()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/articles/details/15');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}

