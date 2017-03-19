<?php

namespace AppBundle\Services\Implementation;

use AppBundle\Services\UrlParserInterface;


class UrlParserService implements UrlParserInterface
{
    /**
     * @var array
     */
    private $urlData;

    /**
     * @param $url
     * @return $this
     */
    public function parse($url)
    {
        $this->urlData = parse_url($url);

        return $this;
    }

    /**
     * @return string
     */
    public function getBasePart()
    {
        if (!$this->urlData) {
            throw new \InvalidArgumentException("Url Data could not be null");
        }

        $basePart = $this->urlData['scheme'] . "://" . $this->urlData['host'];

        if (isset($this->urlData['port']) && !empty($this->urlData['port'])) {
            $basePart .= ':' . $this->urlData['port'];
        }

        return $basePart;
    }
}