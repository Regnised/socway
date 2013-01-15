<?php

namespace Home\ParserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelector;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function indexAction ()
    {
            $client = new Client('http://ru.soccerway.com/national/england/premier-league/20122013/regular-season');

            $request = $client->get();

            $response = $request->send();

            echo $request . "\n\n" . $response;

            return new Response('Hello ', 200, array('Content-Type' => 'text/plain'));;
    }
}
