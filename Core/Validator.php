<?php

namespace Core;
class Validator
{
    public static function string($value, $min = 1, $max = INF): bool
    {
        $length = strlen(trim($value));
        return is_string($value) && $length >= $min && $length <= $max;
    }

    public static function email($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}