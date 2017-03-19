<?php

namespace AppBundle\Services\Implementation;

use AppBundle\Repository\BadDomainRepositoryInterface;
use AppBundle\Services\BadDomainInterface;
use AppBundle\Services\UrlParserInterface;

class BadDomainService implements BadDomainInterface
{
    private $urlParser;
    private $backListDomainArray;

    /**
     * BadDomainService constructor.
     */
    public function __construct(BadDomainRepositoryInterface $badDomainRepository, UrlParserInterface $urlParser)
    {
        $this->backListDomainArray = $badDomainRepository->getBlackListDomainArray();
        $this->urlParser = $urlParser;
    }

    /**
     * @param $url
     * @return bool
     */
    public function isInBlackList($url)
    {
        $basePart = $this->urlParser->parse($url)->getBasePart();

        foreach ($this->backListDomainArray as $domain) {
            if ($domain['name'] === $basePart) {
                return true;
            }
        }

        return false;
    }
}