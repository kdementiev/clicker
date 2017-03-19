<?php

namespace AppBundle\Services;


interface BadDomainInterface
{
    /**
     * @param $referrerUrl
     * @return bool
     */
    public function isInBlackList($referrerUrl);
}