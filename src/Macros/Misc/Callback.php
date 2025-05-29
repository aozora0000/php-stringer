<?php

namespace Stringer\Macros\Misc;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Callback implements StringerCallable
{

    public function __invoke(Stringable $stringable,  ...$arguments): Stringable
    {
        if(($arguments[0] ?? false) && is_callable($arguments[0])) {
            return new Stringer($arguments[0]($stringable));
        }
        return $stringable;
    }
}