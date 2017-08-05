<?php

namespace Tests\AppBundle\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('GET', '/articles',
            ['headers' => [
        'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
    ]]);
        $this->assertEquals(200, $response->getStatusCode());

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('GET', '/articles?limit=5&order=desc&page=2',
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]]);
        $this->assertEquals(200, $response->getStatusCode());

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('GET', '/articles?brand=Apple',
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]]);
        $this->assertEquals(200, $response->getStatusCode());

    }

    public function testProduct()
    {
        $client = new Client(['base_uri' => 'http://bilemo.dev']);

        $response = $client->request('GET', '/articles/1',
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testProductDetails()
    {
        $client = new Client(['base_uri' => 'http://bilemo.dev']);

        $response = $client->request('GET', '/articles/details/15',
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}

