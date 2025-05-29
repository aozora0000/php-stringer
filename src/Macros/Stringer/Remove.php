<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Remove implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $word = $arguments[0] ?? '';
        return $stringable->replace($word, '');
    }
}