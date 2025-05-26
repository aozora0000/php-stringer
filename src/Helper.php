<?php

namespace Stringer;

trait Helper
{
    protected static function some(callable $callback, array $array): bool
    {
        foreach ($array as $value) {
            if ($callback($value)) {
                return true;
            }
        }

        return false;
    }

    protected static function every(callable $callback, array $array): bool
    {
        foreach ($array as $value) {
            if (!$callback($value)) {
                return false;
            }
        }

        return true;
    }

    protected static function is_int(string $argument): bool
    {
        return (bool)preg_match('/^(-|)\d+$/', $argument);
    }
}