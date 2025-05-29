<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class WordWrap implements StringerCallable
{

    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        $width = $arguments[0] ?? 75;
        $break = $arguments[1] ?? "\n";
        $cut = $arguments[2] ?? true;
        return new Stringer(wordwrap($stringable->toString(), $width, $break, $cut));
    }
}