<?php

namespace Stringer\Macros\Misc;

use Stringer\Stringable;
use Stringer\StringerCallable;

class DD implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        if(function_exists('dd') && class_exists('\Symfony\Component\VarDumper\VarDumper')) {
            dd($stringable->toString(), $arguments);
        }
        return $stringable;
    }
}