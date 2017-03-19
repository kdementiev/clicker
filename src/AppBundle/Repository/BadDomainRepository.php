<?php

namespace AppBundle\Repository;

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