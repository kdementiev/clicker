<?php

namespace AppBundle\Services;


interface UrlParserInterface
{
    /**
     * @param $url
     * @return UrlParserInterface
     */
    public function parse($url);

    /**
     * @return string
     */
    public function getBasePart();
}