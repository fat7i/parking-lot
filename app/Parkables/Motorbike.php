<?php

namespace App\Parkables;


class Motorbike implements ParkableInterface
{
    /**
     * @const sting
     */
    const NAME = 'motorbike';
    /**
     * @const float
     */
    const LANE_SIZE = 0.5;

    /**
     * @return string
     */
    function getName()
    {
        return self::NAME;
    }

    /**
     * @return float
     */
    function getLaneSize()
    {
        return self::LANE_SIZE;
    }
}