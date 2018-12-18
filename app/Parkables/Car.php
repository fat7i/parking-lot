<?php

namespace App\Parkables;


class Car implements ParkableInterface
{
    /**
     * @const sting
     */
    const NAME = 'car';
    /**
     * @const float
     */
    const LANE_SIZE = 1;

    /**
     * @return string
     */
    function getName()
    {
        return self::NAME;
    }

    /**
     * @return int
     */
    function getLaneSize()
    {
        return self::LANE_SIZE;
    }
}