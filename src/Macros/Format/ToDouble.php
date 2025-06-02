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
        $precision = self::param($arguments, 0, '');
        return match (true) {
            $stringable->isNumeric() && self::is_int($precision) => round($stringable->toString(), $precision),
            $stringable->isNumeric() => (float)$stringable->toString(),
            default => throw new \InvalidArgumentException("Cannot convert to double"),
        };
    }
}