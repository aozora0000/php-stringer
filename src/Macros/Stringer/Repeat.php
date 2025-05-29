<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Repeat implements StringerCallable
{
    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        return new Stringer(str_repeat($stringable->toString(), $arguments[0] ?? 1));
    }
}