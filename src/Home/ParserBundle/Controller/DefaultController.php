<?php

namespace Home\ParserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;

class DefaultController extends Controller
{
    public function indexAction ()
    {
            $client = new Client('http://ru.soccerway.com/national/england/premier-league/20122013/');

    // Issue a path using a relative URL to the client's base URL
    // Sends to http://www.example.com/api/v1/key/***/users
            $request = $client->get('regular-season');

            $response = $request->send();

    // Relative URL that overwrites the path of the base URL
//            $request = $client->get('/test/123.php?a=b');

    // Issue a head request on the base URL
//            $response = $client->head()->send();
    // Delete user 123
//            $response = $client->delete('users/123')->send();

    // Send a PUT request with custom headers
/*            $response = $client->put('upload/text', array(
                    'X-Header' => 'My Header'
                ), 'body of the request')->send();*/

    // Send a PUT request using the contents of a PHP stream as the body
    // Send using an absolute URL (overrides the base URL)
/*            $response = $client->put('http://www.example.com/upload', array(
                    'X-Header' => 'My Header'
                ), fopen('http://www.test.com/', 'r'));*/

    // Create a POST request with a file upload (notice the @ symbol):
/*            $request = $client->post('http://localhost:8983/solr/update', null, array (
                    'custom_field' => 'my value',
                    'file' => '@/path/to/documents.xml'
                ));*/

    // Create a POST request and add the POST files manually
/*            $request = $client->post('http://localhost:8983/solr/update')
                ->addPostFiles(array(
                    'file' => '/path/to/documents.xml'
                ));*/

    // Responses are objects
            echo $response->getStatusCode() . ' ' . $response->getReasonPhrase() . "\n";

    // Requests and responses can be cast to a string to show the raw HTTP message
//            echo $request . "\n\n" . $response;

    // Create a request based on an HTTP message
        $crawler = new Crawler();
        $crawler->addContent($response);

        print $crawler->filterXPath('descendant-or-self::body/p')->text();


       /* $html = $response;

        $crawler = new Crawler($html);

        foreach ($crawler as $domElement) {
            print $domElement->nodeName;
        }
        return 4;*/
    }
}
