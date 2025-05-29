<?php

namespace Stringer\Macros\Stringer;

use Stringer\Cache;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Camel implements StringerCallable
{
    use Cache;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        return $this->when($stringable, $arguments, fn() => $stringable->studly()->lcfirst());
    }
}