<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Replace implements StringerCallable
{
    public function __invoke(Stringable $stringable, ...$arguments): Stringer
    {
        return new Stringer(str_replace($arguments[0] ?? '', $arguments[1] ?? '', $stringable->toString()));
    }
}