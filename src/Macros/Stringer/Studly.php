<?php

namespace Stringer\Macros\Stringer;

use Stringer\Cache;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Studly implements StringerCallable
{
    use Cache;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        return $this->when($stringable, $arguments, fn(): Stringer => new Stringer(implode('', array_map(
            fn(Stringer $stringer) => $stringer->ucfirst(),
            $stringable->replace(['-', '_'], ' ')->split(' ')
        ))));
    }
}