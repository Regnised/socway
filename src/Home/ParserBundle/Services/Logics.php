<?php
namespace Home\ParserBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class Logics extends Controller
{
    /**
     * @QueryParam(name="from", requirements="\w+", default="2011-01-01", description="matches played from date")
     * @QueryParam(name="to", requirements="\w+", default="2012-02-01", description="matches played to date")
     *
     * @param string $from, $to
     *
     * @return $from, $to
     */
    public function getDateRange($from, $to)
    {

        return array('from' => $from, 'to' => $to);
    }
}
