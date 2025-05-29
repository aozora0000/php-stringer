<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Postfix implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $postfix = $arguments[0] ?? '';
        return new Stringer($stringable->toString() . $postfix);
    }
}