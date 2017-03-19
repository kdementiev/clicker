<?php

namespace AppBundle\Repository\Implementation;

use AppBundle\Repository\ClickRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class ClickRepository extends EntityRepository implements ClickRepositoryInterface
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