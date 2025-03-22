<?php

function dateFormat(string $date, string $format = 'm/d/Y H:i:s'): string
{
    return date($format, strtotime($date));
}