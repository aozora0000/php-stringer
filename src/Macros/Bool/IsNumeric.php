<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsNumeric implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        return is_numeric($stringable->toString());
    }
}