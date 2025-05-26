<?php

namespace Stringer\Macros\Integer;

use Stringer\Stringable;
use Stringer\StringerCallable;

class Count implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): int
    {
        return match(true) {
            $stringable->isEmpty(), $arguments === [], $arguments[0] === '' => 0,
            default => mb_substr_count($stringable->toString(), $arguments[0]),
        };
    }
}