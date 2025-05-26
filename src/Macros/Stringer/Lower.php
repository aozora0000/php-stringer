<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Lower implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringer
    {
        return new Stringer(mb_strtolower($stringable->toString()));
    }
}