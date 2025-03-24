<?php

namespace App\Exceptions;

use Exception;

class EventNotFoundException extends Exception
{
    public function __construct(string $eventId)
    {
        parent::__construct('Event ID ' . $eventId . ' not found');
    }
}