<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class PluralStudly implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {

        $parts = array_filter($stringable->split('/(.)(?=[A-Z])/u'), fn($part) => !$part->isEmpty());
        if(empty($parts)) {
            return $stringable;
        }
        $lastWord = new Stringer(array_pop($parts));
        $parts[] = $lastWord->plural();
        return new Stringer(implode('', array_map(fn($part) => $part->toString(), $parts)));
    }
}