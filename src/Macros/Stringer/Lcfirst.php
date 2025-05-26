<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Lcfirst implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): Stringer
    {
        return new Stringer($stringable->substr(0, 1)->lower() . $stringable->substr(1));
    }
}