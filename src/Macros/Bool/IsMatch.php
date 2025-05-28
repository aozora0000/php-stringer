<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsMatch implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        $pattern = $arguments[0] ?? '';
        return $pattern === '' ? false : preg_match($pattern, $stringable->toString());
    }
}