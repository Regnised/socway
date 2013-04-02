<?php
namespace Home\ParserBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Home\ParserBundle\Entity\Football;
use Home\ParserBundle\Entity\Team;

class Logics extends Controller
{
    /**
     *
     * @param $logic
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template
     */
$team = new Team();
$team2 = new Team();
$game = new Football();
$em = $this->getDoctrine()->getManager();
$entities = $em->getRepository('HomeParserBundle:Team')->findByName($homeTeamName);
$entities2 = $em->getRepository('HomeParserBundle:Team')->findByName($awayTeamName);


if (!$entities)
{
$team->setName($homeTeamName);
$em->persist($team);
} else {
    $team = $em->getRepository('HomeParserBundle:Team')->findOneByName($homeTeamName);
}

if (!$entities2) {
    $team2->setName($awayTeamName);
    $em->persist($team2);
}
else {
    $team2 = $em->getRepository('HomeParserBundle:Team')->findOneByName($awayTeamName);
}

}