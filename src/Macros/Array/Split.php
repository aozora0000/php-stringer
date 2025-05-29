<?php

namespace Stringer\Macros\Array;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Split implements StringerCallable
{
    /**
     * @return Stringer[]
     */
    public function __invoke(Stringable $stringable, string ...$arguments): array
    {
        $sep = new Stringer($arguments[0] ?? ',');
        $words = $sep->isRegexPattern() ?
            preg_split($sep->toString(), $stringable->toString(), -1, PREG_SPLIT_DELIM_CAPTURE) : explode($sep->toString(), $stringable->toString());

        return array_filter(array_map(fn($word): ?Stringer => $word === '' ? null : new Stringer($word), $words));
    }
}