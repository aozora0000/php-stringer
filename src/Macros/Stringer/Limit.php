<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Limit implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $limit = self::param($arguments, 0, 100);
        $end = self::param($arguments, 1, '...');
        if(mb_strwidth($stringable->toString()) <= $limit) {
            return $stringable;
        }

        return new Stringer(rtrim(mb_strimwidth($stringable->toString(), 0, $limit, '', 'UTF-8')) . $end);
    }
}