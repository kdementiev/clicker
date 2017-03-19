<?php

namespace AppBundle\Services\Implementation;

use AppBundle\Repository\BadDomainRepositoryInterface;
use AppBundle\Services\BadDomainInterface;
use AppBundle\Services\UrlParserInterface;

class BadDomainService implements BadDomainInterface
{
    private $urlParser;
    private $blackListDomainArray;

    /**
     * BadDomainService constructor.
     */
    public function __construct(BadDomainRepositoryInterface $badDomainRepository, UrlParserInterface $urlParser)
    {
        $this->blackListDomainArray = $badDomainRepository->getBlackListDomainArray();
        $this->urlParser = $urlParser;
    }

    /**
     * @param $referrerUrl
     * @return bool
     */
    public function isInBlackList($referrerUrl)
    {
        $basePart = $this->urlParser->parse($referrerUrl)->getBasePart();

        foreach ($this->blackListDomainArray as $domain) {
            if ($domain['name'] === $basePart) {
                return true;
            }
        }

        return false;
    }
}