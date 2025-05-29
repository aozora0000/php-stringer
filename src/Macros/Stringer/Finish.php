<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Finish implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $cap = $arguments[0] ?? '';
        return new Stringer(preg_replace(
                '/(?:' . preg_quote($cap, '/') . ')+$/u',
                '',
                $stringable->toString()
            ) . $cap);
    }
}