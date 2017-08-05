<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 05/08/17
 * Time: 10:21
 */
namespace AppBundle\Test\Controler;

use GuzzleHttp\Client;
use Nelmio\ApiDocBundle\Tests\WebTestCase;

class ApiDocTest extends WebTestCase
{

    public function testApiIndex()
    {

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('GET', '/api/doc');
        $this->assertEquals(200, $response->getStatusCode());

    }

    public function testApiOnline()
    {

        $client = new Client(['base_uri' => 'http://bilemo.dev']);
        $response = $client->request('GET', '/api/doc/online?_doc=1.0');
        $this->assertEquals(200, $response->getStatusCode());

    }

}
