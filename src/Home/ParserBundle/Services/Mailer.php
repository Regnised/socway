<?php
namespace Home\ParserBundle;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class Mailer extends Controller
{
// ...
    public function __construct($a)
    {
        $this->a = $a;

    }

public function send($a)
{
    $a = $a + 1;
    return new Response($a);


}

}