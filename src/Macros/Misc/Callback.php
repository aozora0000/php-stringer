<?php

namespace Stringer\Macros\Misc;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Callback implements StringerCallable
{

    use Helper;

    public function __invoke(Stringable $stringable,  ...$arguments): Stringable
    {
        $callback = self::param($arguments, 0, false);
        if(is_callable($callback)) {
            return new Stringer($callback($stringable));
        }

        return $stringable;
    }
}