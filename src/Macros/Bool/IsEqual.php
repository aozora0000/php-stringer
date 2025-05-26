<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsEqual implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        return $stringable->toString() === ($arguments[0] ?? '');
    }
}