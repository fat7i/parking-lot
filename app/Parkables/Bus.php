<?php

namespace App\Parkables;


class Bus implements ParkableInterface
{
    /**
     * @const sting
     */
    const NAME = 'bus';

    /**
     * @const float
     */
    const LANE_SIZE = 2;

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