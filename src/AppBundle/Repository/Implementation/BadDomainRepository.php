<?php

namespace AppBundle\Repository\Implementation;

use AppBundle\Repository\BadDomainRepositoryInterface;
use Doctrine\ORM\EntityRepository;


class BadDomainRepository extends EntityRepository implements BadDomainRepositoryInterface
{
    /**
     * @return array
     */
    public function getBlackListDomainArray()
    {
        return $this->createQueryBuilder('b')
            ->select('b.name')
            ->getQuery()
            ->getArrayResult();
    }
}