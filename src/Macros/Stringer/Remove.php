<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Remove implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $word = self::param($arguments, 0, '');
        return $stringable->replace($word, '');
    }
}