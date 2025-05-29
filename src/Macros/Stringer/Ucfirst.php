<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Ucfirst implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        return new Stringer($stringable->substr(0, 1)->upper() . $stringable->substr(1));
    }
}