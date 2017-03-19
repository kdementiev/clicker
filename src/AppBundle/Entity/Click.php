<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\Request;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClickRepository")
 * @ORM\Table(name="click")
 * @UniqueEntity(fields={"userAgent", "ip", "referrer", "firstParam"})
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
     * @ORM\Column(type="integer")
     */
    private $error;

    /**
     * @ORM\Column(type="boolean", name="bad_domain")
     */
    private $badDomain;

    /**
     * Click constructor.
     */
    public function __construct()
    {
        $this->badDomain = false;
        $this->error = 0;
    }

    /**
     * @param Request $request
     * @return Click
     */
    public static function createByRequest(Request $request)
    {
        $click = new Click();
        $click->firstParam = $request->query->get('param1');
        $click->secondParam = $request->query->get('param2');
        $click->userAgent = $request->headers->get('user-agent');
        $click->referrer = $request->headers->get('referer');
        $click->ip = $request->getClientIp();

        return $click;
    }

    /**
     * Get id
     *
     * @return guid
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return Click
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Click
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set referrer
     *
     * @param string $referrer
     *
     * @return Click
     */
    public function setReferrer($referrer)
    {
        $this->referrer = $referrer;

        return $this;
    }

    /**
     * Get referrer
     *
     * @return string
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * Set firstParam
     *
     * @param string $firstParam
     *
     * @return Click
     */
    public function setFirstParam($firstParam)
    {
        $this->firstParam = $firstParam;

        return $this;
    }

    /**
     * Get firstParam
     *
     * @return string
     */
    public function getFirstParam()
    {
        return $this->firstParam;
    }

    /**
     * Set secondParam
     *
     * @param string $secondParam
     *
     * @return Click
     */
    public function setSecondParam($secondParam)
    {
        $this->secondParam = $secondParam;

        return $this;
    }

    /**
     * Get secondParam
     *
     * @return string
     */
    public function getSecondParam()
    {
        return $this->secondParam;
    }

    /**
     * Set error
     *
     * @param boolean $error
     *
     * @return Click
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Get error
     *
     * @return boolean
     */
    public function getError()
    {
        return $this->error;
    }

    public function increaseErrorCounter()
    {
        $this->error++;
    }

    /**
     * Set badDomain
     *
     * @param boolean $badDomain
     *
     * @return Click
     */
    public function setBadDomain($badDomain)
    {
        $this->badDomain = $badDomain;

        return $this;
    }

    /**
     * Get badDomain
     *
     * @return boolean
     */
    public function getBadDomain()
    {
        return $this->badDomain;
    }
}
