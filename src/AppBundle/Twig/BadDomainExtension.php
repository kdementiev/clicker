<?php

namespace AppBundle\Twig;


class BadDomainExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('is_bad_domain', [$this, 'isBadDomain']),
        ];
    }

    public function isBadDomain($url)
    {
        return true;
    }
}