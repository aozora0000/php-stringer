<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Offset implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $offset = (int)self::param($arguments, 0, 0);
        $length = (int)self::param($arguments, 1, $stringable->length());
        return match (true) {
            $stringable->isEmpty(), $stringable->length() <= $offset => new Stringer(''),
            default => new Stringer(mb_substr($stringable->toString(), $offset, $length)),
        };
    }
}