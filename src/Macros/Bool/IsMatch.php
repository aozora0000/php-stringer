<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class IsMatch implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        $pattern = self::param($arguments, 0, '');
        return $pattern === '' ? false : preg_match($pattern, $stringable->toString());
    }
}