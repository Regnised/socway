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




//            $em = $this->getDoctrine()->getManager();



    return  array($team, $team2);

    }
}