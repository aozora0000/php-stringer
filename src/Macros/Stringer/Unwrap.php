<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\StringerCallable;

class Unwrap implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $prefix = $arguments[0] ?? '';
        $postfix = $arguments[1] ?? $prefix;
        return $stringable->ltrim($prefix)->rtrim($postfix);
    }
}