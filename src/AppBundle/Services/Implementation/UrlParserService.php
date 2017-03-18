<?php

namespace AppBundle\Services\Implementation;

use AppBundle\Services\UrlParserInterface;


class UrlParserService implements UrlParserInterface
{
    private $urlData;

    public function parse($url)
    {
        $this->urlData = parse_url($url);

        return $this;
    }

    public function getBasePart()
    {
         $basePart = $this->urlData['scheme'] . "://" . $this->urlData['host'];

         if (isset($this->urlData['port']) && !empty($this->urlData['port'])) {
             $basePart .= ':' . $this->urlData['port'];
         }

         return $basePart;
    }
}