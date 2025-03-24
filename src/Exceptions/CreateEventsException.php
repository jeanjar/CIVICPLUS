<?php

namespace App\Exceptions;

use Exception;

class CreateEventsException extends Exception
{
    public function __construct(string $message)
    {
        error_log($message);
        parent::__construct('Unable to create event => ' . $message);
    }
}