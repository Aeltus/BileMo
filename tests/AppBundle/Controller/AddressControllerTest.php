<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/07/17
 * Time: 19:16
 */
namespace Tests\AppBundle\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class AddressControllerTest extends WebTestCase
{

    protected $customerId;

    protected $addressId;

    protected function setUp()
    {
        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('GET', '/customers/2',
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]]);

        $customer = json_decode($response->getBody(), true);

        $this->customerId = $customer['id'];

        $this->addressId = $customer['delivery_addresses'][0]['id'];
    }

    public function testCreate()
    {
        $data = '
                {
                    "address1": "40 rue de la place",
                    "address2": null,
                    "address3": null,
                    "city": {
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

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('POST', '/address/'.$this->customerId,
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD',
                'Content-Type' => 'application/json'
            ],
             'body' => $data
            ]);

        $this->assertEquals(201, $response->getStatusCode());


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

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('PUT', '/address/'.$this->customerId,
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD',
                'Content-Type' => 'application/json'
            ],
                'body' => $data
            ]);
        $this->assertEquals(200, $response->getStatusCode());


    }

    public function testDelete()
    {

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('DELETE', '/address/'.$this->addressId,
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
                ]
            ]);
        $this->assertEquals(202, $response->getStatusCode());

    }

}


