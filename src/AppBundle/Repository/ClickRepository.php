<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ClickRepository extends EntityRepository
{
    public function getBadReferrers()
    {
        return $this->createQueryBuilder('c')
            ->where('c.error > :count')
            ->groupBy('c.referrer')
            ->setParameter('count', 0)
            ->getQuery()
            ->getResult();
    }
}