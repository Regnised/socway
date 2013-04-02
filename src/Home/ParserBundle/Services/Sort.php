<?php
namespace Home\ParserBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class Mailer extends Controller
{
    /**
     * @param $sendmail
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template
     */
    public function send($sendmail)
    {
        $sendmail = $sendmail + 1;
        return $sendmail;
    }

}