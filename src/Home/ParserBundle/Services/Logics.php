<?php
namespace Home\ParserBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Home\ParserBundle\Entity\Team;
use Guzzle\Http\Client;
use Symfony\Component\CssSelector\CssSelector;
use Guzzle\Common\Exception\ExceptionCollection;
use Symfony\Component\Validator\Validation;


class Logics extends Controller
{
    /**
     *
     * @param $homeTeam, $awayTeam
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template
     */


    /**
     * @var EntityManager
     */
    protected  $container;

    public function __construct() {
        $this->container = $this->getDoctrine()->getManager();
//        $this->em = $this->container->get('doctrine');
    }


    public function dbase($homeTeam, $awayTeam) {


            $team = new Team();
            $team2 = new Team();

//            $em = $this->getDoctrine()->getManager();
            $entities = $this->container->get('doctrine')->getRepository('HomeParserBundle:Team')->findByName($homeTeam);
            $entities2 = $$this->container->get('doctrine')->getRepository('HomeParserBundle:Team')->findByName($awayTeam);


            if (!$entities)
            {
            $team->setName($homeTeam);
                $this->em->persist($team);
            } else {
                $team = $this->container->get('doctrine')->getRepository('HomeParserBundle:Team')->findOneByName($homeTeam);
            }

            if (!$entities2) {
                $team2->setName($awayTeam);
                $this->em->persist($team2);
            }
            else {
                $team2 = $this->container->get('doctrine')->getRepository('HomeParserBundle:Team')->findOneByName($awayTeam);
            }


    return  array($team, $team2);

    }
}