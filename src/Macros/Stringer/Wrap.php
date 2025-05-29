<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Wrap implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $prefix = $arguments[0] ?? '';
        $postfix = $arguments[1] ?? $prefix;
        return new Stringer(implode('', [$prefix, $stringable->toString(), $postfix]));
    }
}