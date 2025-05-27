<?php

namespace Stringer\Macros\Misc;

use Stringer\Stringable;
use Stringer\StringerCallable;

class DD implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): mixed
    {
        if(function_exists('dd')) {
            dd($stringable->toString(), $arguments);
        }
        return $stringable;
    }
}