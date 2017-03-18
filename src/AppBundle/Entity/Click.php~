<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity
 * @ORM\Table(name="click")
 */
class Click
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="ua")
     */
    private $userAgent;

    /**
     * @ORM\Column(type="string", name="ip")
     */
    private $ip;

    /**
     * @ORM\Column(type="string", name="ref")
     */
    private $referrer;

    /**
     * @ORM\Column(type="string", name="param1")
     */
    private $firstParam;

    /**
     * @ORM\Column(type="string", name="param2")
     */
    private $secondParam;

    /**
     * @ORM\Column(type="boolean")
     */
    private $error;

    /**
     * @ORM\Column(type="boolean", name="bad_domain")
     */
    private $badDomain;

}