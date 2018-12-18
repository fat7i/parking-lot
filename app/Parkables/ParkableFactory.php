<?php

namespace App\Parkables;

use App\Exceptions\InvalidTypeException;


class ParkableFactory
{
    /**
     * @param string $parkableType
     * @return ParkableInterface
     * @throws InvalidTypeException
     */
    static function make(string $parkableType)
    {
        switch ($parkableType) {
            case 'car';
                return new Car();
                break;
            case 'bus';
                return new Bus();
                break;
            case 'motorbike';
                return new Motorbike();
                break;
            default:
                throw new InvalidTypeException();
        }
    }
}