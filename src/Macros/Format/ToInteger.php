<?php

namespace Stringer\Macros\Format;

use Stringer\Stringable;
use Stringer\StringerCallable;

class ToInteger implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): int
    {
        if($stringable->isInteger()) {
            return (int)$stringable->toString();
        }

        throw new \InvalidArgumentException("Cannot convert to integer");
    }
}