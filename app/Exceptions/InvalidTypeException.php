<?php

namespace App\Exceptions;


class InvalidTypeException extends \Exception
{
    protected $message = 'The type provided has no corresponding object';

}