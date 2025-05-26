<?php

namespace Stringer\Macros\Array;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Split implements StringerCallable
{
    /**
     * @param Stringable $stringable
     * @param string ...$arguments
     * @return Stringer[]
     */
    public function __invoke(Stringable $stringable, string ...$arguments): array
    {
        return array_map(fn($word) => new Stringer($word), explode($arguments[0] ?? ',', $stringable->toString()));
    }
}