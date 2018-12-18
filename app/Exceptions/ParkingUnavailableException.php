<?php

namespace App\Exceptions;


class ParkingUnavailableException extends \Exception
{
    protected $message = 'Parking is not available right now, Please visit us later';

}