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
            array("1", "39"),
            array("2", "39"),
            array("3", "39"),
            array("4", "39"),
            array("5", "38"),
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
