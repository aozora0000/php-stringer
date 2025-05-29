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

    protected static function is_class_string(string $argument): bool
    {
        return class_exists($argument);
    }

    protected static function is_class_method_string(string $argument, string $sep = '::'): bool
    {
        if(str_contains($argument, $sep)) {
            [$class, $method] = explode($sep, $argument);
            return class_exists($class) && method_exists($class, $method);
        }
        return false;
    }
}