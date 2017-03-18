<?php

namespace AppBundle\Services\Implementation;

use AppBundle\Services\LinkGeneratorInterface;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class LinkGeneratorService implements LinkGeneratorInterface
{
    const MIN_LINKS_COUNT = 1;
    const MAX_LINKS_COUNT = 20;

    /** @var Router */
    private $router;

    /**
     * @param $count
     * @return array
     */
    public function generate($count = 1)
    {
        if ($count < self::MIN_LINKS_COUNT || $count > self::MAX_LINKS_COUNT) {
            throw new InvalidArgumentException("Wrong count param");
        }

        $links = [];

        for ($i = 0; $i < $count; $i++) {
            $links[] = $this->router->generate('click_index', [
                'param1' => $i,
                'param2' => $i + 2
            ], UrlGeneratorInterface::ABSOLUTE_URL);
        }

        return $links;
    }

    /**
     * @param Router $router
     */
    public function setRouter(Router $router)
    {
        $this->router = $router;
    }
}