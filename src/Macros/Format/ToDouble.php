<?php

namespace Stringer\Macros\Format;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class ToDouble implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): float
    {
        return match (true) {
            $stringable->isNumeric() && self::is_int($arguments[0] ?? '') => round($stringable->toString(), $arguments[0]),
            $stringable->isNumeric() => (float)$stringable->toString(),
            default => throw new \InvalidArgumentException("Cannot convert to double"),
        };
    }
}