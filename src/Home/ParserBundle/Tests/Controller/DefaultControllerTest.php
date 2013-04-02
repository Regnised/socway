<?php

namespace Home\ParserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/api/matches',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json')

        );

        $this->assertTrue($client->getResponse()->isSuccessful());;
    }
}
