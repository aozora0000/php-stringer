<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsEmpty implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        return $stringable->toString() === '';
    }
}