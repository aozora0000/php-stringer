<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsIP implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        if ($stringable->isIPv4()) {
            return true;
        }
        return (bool) $stringable->isIPv6();
    }
}