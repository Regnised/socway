<?php

namespace Home\ParserBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class EntityTest extends WebTestCase
{

    protected function getContainer()
    {
        if (null === static::$kernel) {
            static::createClient();
        }
        static::$kernel->boot();

        return static::$kernel->getContainer();
    }

    public function CountGames()
    {
        return array(
            array("1", "113"),
            array("2", "113"),
            array("3", "114"),
            array("4", "114"),
            array("5", "114"),
        );
    }

    /**
     * @dataProvider CountGames
     */
    public function testfindCountLosses($data, $result)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $this->assertEquals($result,$em->getRepository('HomeParserBundle:Football')->findCountGames($data));
    }



}
