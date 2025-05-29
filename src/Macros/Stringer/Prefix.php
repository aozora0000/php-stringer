<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Prefix implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $prefix = $arguments[0] ?? '';
        return new Stringer($prefix . $stringable->toString());
    }
}