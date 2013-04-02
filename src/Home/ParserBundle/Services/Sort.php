<?php
namespace Home\ParserBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class Sort extends Controller
{
    /**
     * @param $sorted
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template
     */
    function build_sorter($key) {
        return function ($a, $b) use ($key) {
            return strnatcmp($a[$key], $b[$key]);
        };
    }

}