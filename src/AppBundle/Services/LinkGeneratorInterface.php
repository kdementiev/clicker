<?php

namespace AppBundle\Services;


interface LinkGeneratorInterface
{
    /**
     * @param int $count
     * @return array
     */
    public function generate($count);
}