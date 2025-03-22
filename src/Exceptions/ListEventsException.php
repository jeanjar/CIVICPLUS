<?php

namespace App\Exceptions;

use Exception;

class ListEventsException extends Exception
{
    public function __construct(string $message)
    {
        error_log($message);
        parent::__construct('Unable to list events => ' . $message);
    }
}