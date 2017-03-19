<?php

namespace AppBundle\Twig;

use AppBundle\Services\BadDomainInterface;


class BadDomainExtension extends \Twig_Extension
{
    private $badDomainService;

    /**
     * BadDomainExtension constructor.
     */
    public function __construct(BadDomainInterface $badDomain)
    {
        $this->badDomainService = $badDomain;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('is_bad_domain', [$this, 'isBadDomain']),
        ];
    }

    /**
     * @param $url
     * @return bool
     */
    public function isBadDomain($url)
    {
        return $this->badDomainService->isInBlackList($url);
    }
}