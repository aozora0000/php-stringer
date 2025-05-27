<?php

namespace Stringer\Macros\Misc;

use Stringer\Stringable;
use Stringer\StringerCallable;

class Dump implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): mixed
    {
        if(function_exists('dump')) {
            dump($stringable->toString(), $arguments);
        }
        return $stringable;
    }
}