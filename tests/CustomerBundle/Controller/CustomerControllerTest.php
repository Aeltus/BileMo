<?php

namespace CustomerBundle\Tests\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerControllerTest extends WebTestCase
{

    public function testCustomers()
    {
        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('GET', '/customers',
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]]);
        $this->assertEquals(200, $response->getStatusCode());

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('GET', '/customers?limit=5&order=desc&page=1',
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]]);
        $this->assertEquals(200, $response->getStatusCode());

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('GET', '/customers?isAvailable=FALSE',
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCustomer()
    {
        $client = new Client(['base_uri' => 'http://bilemo.dev']);

        $response = $client->request('GET', '/customers/2',
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCreate()
    {
        $data = '{
    "password": "my_encoded_password",
    "salt": "my_encoded_salt",
    "is_checked": true,
    "delivery_addresses": [
        {
            "address1": "50 rue de la place",
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
    ],
    "name": "Danjard",
    "surname": "David",
    "billing_address": {
        "address1": "30 rue de la Mairie",
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
    },
    "phone": "0468000050",
    "cell_phone": null,
    "mail": "david150.danjard@monmail.com",
    "is_available": true
}';

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('POST', '/customers',
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
        $data = '{
    "password": "my_encoded_password",
    "salt": "my_encoded_salt",
    "is_checked": true,
    "delivery_addresses": [
        {
            "address1": "50 rue de la place",
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
    ],
    "name": "Danjard",
    "surname": "Daniel",
    "billing_address": {
        "address1": "30 rue de la Mairie",
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
    },
    "phone": "0468000050",
    "cell_phone": null,
    "mail": "david150.danjard@monmail.com",
    "is_available": true
}';

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('GET', '/customers?order=desc&limit=1',
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]]);
        $customer = json_decode($response->getBody(), true);

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('PUT', '/customers/'.$customer['_embedded']['items'][0]['id'],
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
        $response = $client->request('GET', '/customers?order=desc&limit=1',
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]]);
        $customer = json_decode($response->getBody(), true);
        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('DELETE', '/customers/'.$customer['_embedded']['items'][0]['id'],
            ['headers' => [
                'Authorization' => 'EAAbYujYlTvcBAHhHLgZC0lxZAuES99TLaxKklSIh5e5jfnuZAvG1PqMB2bVRkGqcZCJ63sg2BZAQA4fflrA7s7YQNZBvd4KWesrV0n52rGAxbpXWbNSQavRevWDm8UIg6pnCl0t0fMLVlMAUAmKWRPOk6rl8FK7MO6dHfe6R4ZBFAZDZD'
            ]
            ]);
        $this->assertEquals(204, $response->getStatusCode());

        $kernel = static::createKernel();
        $kernel->boot();
        $em = $kernel->getContainer()
                     ->get('doctrine')
                     ->getManager()
        ;
        $repo = $em->getRepository('CustomerBundle:Customer');
        $customerToDelete = $repo->findOneById($customer['_embedded']['items'][0]['id']);
        $this->assertEquals(NULL, $em->remove($customerToDelete));

        $em->flush();

    }

}
