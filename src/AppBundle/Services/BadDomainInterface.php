<?php

namespace AppBundle\Services;


interface BadDomainInterface
{
    /**
     * @param $url
     * @return bool
     */
    public function isInBlackList($url);
}