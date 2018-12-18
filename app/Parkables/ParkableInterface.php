<?php

namespace App\Parkables;


interface ParkableInterface
{
    /**
     * @return string
     */
    function getName();

    /**
     * @return int
     */
    function getLaneSize();
}