<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Substr implements StringerCallable
{
    /**
     * @param int ...$arguments
     * @return Stringer
     */
    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        $start = $arguments[0] ?? 0;
        $length = $arguments[1] ?? null;
        return new Stringer(mb_substr($stringable, $start, $length));
    }
}