<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Upper implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringer
    {
        return new Stringer(mb_strtoupper($stringable->toString()));
    }
}