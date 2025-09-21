<?php

namespace App\Helps;

class Example
{
    public static string|null $help = 'This is an example help property.';
    public static function help(): string
    {
        return self::$help;
    }
}
