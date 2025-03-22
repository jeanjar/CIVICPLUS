<?php

namespace App\Http\Request;

class Handler
{
    public function get(): array
    {
        return $_GET;
    }

    public function post(): array
    {
        return $_POST;
    }
}