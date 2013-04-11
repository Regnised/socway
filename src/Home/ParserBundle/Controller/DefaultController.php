<?php

namespace Home\ParserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelector;
use Symfony\Component\HttpFoundation\Response;
use Guzzle\Common\Exception\ExceptionCollection;
use Home\ParserBundle\Entity\Football;
use Home\ParserBundle\Entity\Team;
use DateTime;
use Symfony\Component\Validator\Validation;
use FOS\RestBundle\FOSRestBundle;
use JMS\SerializerBundle\JMSSerializerBundle;
use FOS\RestBundle\View\View;
use Home\ParserBundle\Services\Mailer;

use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;



class DefaultController extends Controller
{
    public function indexAction ()

    {

        $count=0;

        for ($x=0; $x<13; $x++) {
        $client = new Client('');
        $req = $client->get('http://www.soccerway.com/a/block_competition_matches');
        $q = $req->getQuery();
        $q->set('block_id', 'page_competition_1_block_competition_matches_7');
        $q->set('callback_params', '{"page": '.($count-1).', "round_id": "14829", "outgroup":"","view":"2"}');
        $q->set('action','changePage');
        $q->set('params', '{"page":'.$count.'}');

        $req  = $req->send();
        $count = $count - 1;
            $req = $req->getBody();
            $data = json_decode((string)$req, $explanationOfParam = true);

            $mycrawler = new Crawler($data);
            $crawler=$mycrawler->filter('table.matches > tbody > tr');
            foreach ($crawler as $domElement)
            {
                $elBytagSpan = $domElement->getElementsByTagName('span');
                $elBytagA = $domElement->getElementsByTagName('a');
                $dateGame = $elBytagSpan->item(1)->nodeValue;
                $homeTeamName = $elBytagA->item(0)->getAttribute('title');
                $account = $elBytagA->item(1)->nodeValue;
                $awayTeamName = $elBytagA->item(2)->getAttribute('title');
                $em = $this->getDoctrine()->getManager();


                $team = new Team();
                $team2 = new Team();
                $entities = $em->getRepository('HomeParserBundle:Team')->findByName($homeTeamName);
                $entities2 = $em->getRepository('HomeParserBundle:Team')->findByName($awayTeamName);


                if (!$entities)
                {
                    $team->setName($homeTeamName);
                    $em->persist($team);
                } else {
                    $team = $this->container->get('doctrine')->getRepository('HomeParserBundle:Team')->findOneByName($homeTeamName);
                }

                if (!$entities2) {
                    $team2->setName($awayTeamName);
                    $em->persist($team2);
                }
                else {
                    $team2 = $this->container->get('doctrine')->getRepository('HomeParserBundle:Team')->findOneByName($awayTeamName);
                }

                $game = new Football();
                $game->setDate(DateTime::createFromFormat('d/m/y', $dateGame));
                $game->setHts($account{0});
                $game->setAts($account{4});
                $game->setFootballH($team);
                $game->setFootballA($team2);

                $em->persist($game);
                $em->flush();

        }
        }
        return $this->render('HomeParserBundle:Default:index.html.twig');
    }

    /**
     * @QueryParam(name="from", requirements="\d{4}-\d{2}-\d{2}", default="2011-01-01", description="matches played from date")
     * @QueryParam(name="to", requirements="\d{4}-\d{2}-\d{2}", default="2012-02-01", description="matches played to date")
     *
     * @param string $from, $to
     *
     */
    public function standingsAction(ParamFetcher $paramFetcher) {
        $from = $paramFetcher->get('from');
        $to = $paramFetcher->get('to');
        $em = $this->getDoctrine()->getManager();
        $teamNames = $em->getRepository('HomeParserBundle:Team')->findAll();

        foreach ($teamNames as $team) {
            $teamName = $team->getName();
            $teamId = $team->getId();

            $countGames = $em->getRepository('HomeParserBundle:Football')->findCountGames($teamId, $from, $to);
            $countWins = $em->getRepository('HomeParserBundle:Football')->findCountWins($teamId, $from, $to);
            $countDraws = $em->getRepository('HomeParserBundle:Football')->findCountDraws($teamId, $from, $to);
            $countLosses = $em->getRepository('HomeParserBundle:Football')->findCountLosses($teamId, $from, $to);
            $summPoints = $countWins*3 + $countDraws;

            $arrayData[] = array(
                "place" => 1,
                "team" => $teamName,
                "played" => $countGames,
                "wins" => $countWins,
                "draws" => $countDraws,
                "losses" => $countLosses,
                "points" => $summPoints
            );
        }

        $sort = $this->get('sort_array');
        $sorting = $sort->build_sorter('points');

        usort($arrayData, $sorting);
        $arrayData = array_reverse($arrayData);

        $i = 1;
        foreach ($arrayData as $key => $value) {
            $arrayData[$key]['place'] = $i;
            ++$i;
        }

        $view = View::create();
        $view->setFormat('json');
        $view->setData($arrayData);

        return $this->get('fos_rest.view_handler')->handle($view);
    }


    /**
     * @QueryParam(name="team", requirements="", description="all matches one team")
     *
     * @param string $team
     *
     */
    public function matchesAction(ParamFetcher $paramFetcher) {
        $teamNamme = $paramFetcher->get('team');
//        echo $teamNamme;exit;
        $repositoryFootball = $this->getDoctrine()
            ->getRepository('HomeParserBundle:Football');
        $repositoryTeam = $this->getDoctrine()
            ->getRepository('HomeParserBundle:Team');

        $teamName = $repositoryTeam->findOneByName($teamNamme);
//        echo $teamName;exit;
        foreach ($teamName as $teamN) {
            $teamId = $teamN->getId();
        }


        $teamId = $teamName->getId();

        $teamNames = $repositoryFootball->findTeamGames($teamId);

        foreach ($teamNames as $game) {
            $arrayData[] = array(
                "hometeam" => $game->getFootballH()->getName(),
                "awayteam" => $game->getFootballA()->getName(),
                "date" => $game->getDate(),
                "goalH" => $game->getHts(),
                "goalA" => $game->getAts()
            );
        }

        $view = View::create();
        $view->setFormat('json');
        $view->setData($arrayData);

        return $this->get('fos_rest.view_handler')->handle($view);
    }


}