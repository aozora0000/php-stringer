<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Offset implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $offset = (int)($arguments[0] ?? 0);
        $length = (int)($arguments[1] ?? $stringable->length());
        return match (true) {
            $stringable->isEmpty(), $stringable->length() <= $offset => new Stringer(''),
            default => new Stringer(mb_substr($stringable->toString(), $offset, $length)),
        };
    }
}