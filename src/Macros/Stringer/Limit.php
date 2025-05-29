<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Limit implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $limit = $arguments[0] ?? 100;
        $end = $arguments[1] ?? '...';
        if(mb_strwidth($stringable->toString()) <= $limit) {
            return $stringable;
        }

        return new Stringer(rtrim(mb_strimwidth($stringable->toString(), 0, $limit, '', 'UTF-8')) . $end);
    }
}