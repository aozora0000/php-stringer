<?php

namespace Stringer\Macros\Array;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Split implements StringerCallable
{
    use Helper;
    /**
     * @return Stringer[]
     */
    public function __invoke(Stringable $stringable, string ...$arguments): array
    {
        $sep = new Stringer(self::param($arguments, 0, ','));
        $null = (bool)self::param($arguments, 1,false);
        $words = $sep->isRegexPattern() ?
            preg_split($sep->toString(), $stringable->toString(), -1, PREG_SPLIT_NO_EMPTY + PREG_SPLIT_DELIM_CAPTURE) :
            explode($sep->toString(), $stringable->toString());
        if (array_filter($words) === []) {
            return [];
        }

        if ($null) {
            return array_map(fn($word): ?Stringer => $word === '' ? null : new Stringer($word), $words);
        }

        return array_filter(array_map(fn($word): ?Stringer => $word === '' ? null : new Stringer($word), $words));

    }
}