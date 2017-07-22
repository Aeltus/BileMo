<?php

namespace CustomerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerControllerTest extends WebTestCase
{

    public function testCustomers()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/customers');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client = static::createClient();
        $crawler = $client->request('GET', '/customers?limit=5&order=desc&page=1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client = static::createClient();
        $crawler = $client->request('GET', '/customers?isAvailable=FALSE');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testCustomer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/customers/2');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
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
    "consumer_key": "1",
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
    "mail": "david60.danjard@monmail.com",
    "is_available": true
}';

        $client = static::createClient();
        $crawler = $client->request('POST', '/customers', [], [], ['CONTENT_TYPE' => 'application/json'], $data);
        $response = $client->getResponse();
        $this->assertEquals(201, $response->getStatusCode());
        $customer = json_decode($response->getContent(), true);

        $this->assertInternalType('array', $customer);
        $this->assertArrayHasKey('id', $customer);
        $this->assertArrayHasKey('mail', $customer);
        $this->assertArrayHasKey('name', $customer);

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
    "consumer_key": "1",
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
    "mail": "david60.danjard@monmail.com",
    "is_available": true
}';

        $client = static::createClient();
        $crawler = $client->request('GET', '/customers?order=desc&limit=1');
        $response = $client->getResponse();
        $customer = json_decode($response->getContent(), true);
        $crawler = $client->request('PUT', '/customers/'.$customer['_embedded']['items'][0]['id'], [], [], ['CONTENT_TYPE' => 'application/json'], $data);
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $customer = json_decode($response->getContent(), true);
        $this->assertEquals('Daniel', $customer['surname']);
    }

    public function testAddAddress()
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

        $crawler = $client->request('GET', '/customers?order=desc&limit=1');
        $response = $client->getResponse();
        $customer = json_decode($response->getContent(), true);

        $crawler = $client->request('POST', '/address/'.$customer['_embedded']['items'][0]['id'], [], [], ['CONTENT_TYPE' => 'application/json'], $data);
        $response = $client->getResponse();
        $this->assertEquals(201, $response->getStatusCode());
        $address = json_decode($response->getContent(), true);

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

    }

    public function testDelete()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/customers?order=desc&limit=1');
        $response = $client->getResponse();
        $customer = json_decode($response->getContent(), true);

        $crawler = $client->request('DELETE', '/customers/'.$customer['_embedded']['items'][0]['id']);
        $response = $client->getResponse();
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
