<?php

namespace App\Exceptions;

use Exception;

class RemoveMessageFromBagException extends Exception
{
    public function __construct()
    {
        parent::__construct('You cannot remove messages using only $key');
    }
}