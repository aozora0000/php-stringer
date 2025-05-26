<?php

namespace Stringer\Macros\Format;

use Stringer\Stringable;
use Stringer\StringerCallable;

class ToHex implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): string
    {
        return match (true) {
            $stringable->isInteger() => dechex($stringable->toString()),
            default => throw new \InvalidArgumentException("Cannot convert to hex"),
        };
    }
}