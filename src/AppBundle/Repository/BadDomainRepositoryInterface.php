<?php

namespace AppBundle\Repository;


interface BadDomainRepositoryInterface
{
    /**
     * @return array
     */
    public function getBlackListDomainArray();
}