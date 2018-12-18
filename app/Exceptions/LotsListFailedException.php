<?php

namespace App\Exceptions;


class LotsListFailedException extends \Exception
{
    protected $message = 'Failed to get lots list';
}