<?php

namespace AppBundle\Services;

interface UrlParserInterface
{
    public function parse($url);

    public function getBasePart();
}