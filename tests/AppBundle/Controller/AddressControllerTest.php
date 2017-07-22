<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/07/17
 * Time: 19:16
 */
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class AddressControllerTest extends WebTestCase
{

    protected $customerId;

    protected $addressId;

    protected function setUp()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/customers?order=desc&limit=1');
        $response = $client->getResponse();
        $customer = json_decode($response->getContent(), true);
        $this->customerId = $customer['_embedded']['items'][0]['id'];

        $this->addressId = $customer['_embedded']['items'][0]['delivery_addresses'][0]['id'];
    }

    public function testCreate()
    {
        $data = '
                {
                    "address1": "40 rue de la place",
                    "address2": null,
                    "address3": null,
                    "city": {
                        "id": 1,
                        "name": "Limoux",
                        "zip_code": "11300",
                        "country": {
                            "name": "France"
                        }
                    },
                    "is_available": true,
                    "is_default": true,
                    "customer_address": null
                }
                ';

        $client = static::createClient();
        $crawler = $client->request('POST', '/address/'.$this->customerId, [], [], ['CONTENT_TYPE' => 'application/json'], $data);
        $response = $client->getResponse();
        $this->assertEquals(201, $response->getStatusCode());

        $data = '';

        $client = static::createClient();
        $crawler = $client->request('POST', '/address/'.$this->customerId, [], [], ['CONTENT_TYPE' => 'application/json'], $data);
        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testUpdate()
    {

        $data = '
        {
            "address1": "60 rue de la place",
            "address2": null,
            "address3": null,
            "city": {
                "id": 1,
                "name": "Limoux",
                "zip_code": "11300",
                "country": {
                    "name": "France"
                }
            },
            "is_available": true,
            "is_default": true,
            "customer_address": null
        }
        ';

        $client = static::createClient();
        $crawler = $client->request('PUT', '/address/'.$this->customerId, [], [], ['CONTENT_TYPE' => 'application/json'], $data);
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $data = '';

        $client = static::createClient();
        $crawler = $client->request('PUT', '/address/'.$this->customerId, [], [], ['CONTENT_TYPE' => 'application/json'], $data);
        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());

    }

    public function testDelete()
    {

        $client = static::createClient();
        $crawler = $client->request('DELETE', '/address/'.$this->addressId);
        $response = $client->getResponse();
        $this->assertEquals(204, $response->getStatusCode());

    }

}


