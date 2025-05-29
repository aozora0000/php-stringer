<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Concat implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $arguments = array_filter($arguments);
        return new Stringer(implode('', [$stringable->toString(), ...$arguments]));
    }
}