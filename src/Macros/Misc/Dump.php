<?php

namespace Stringer\Macros\Misc;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Dump implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        if(function_exists('dump') && class_exists('\Symfony\Component\VarDumper\VarDumper')) {
            dump($stringable->toString(), $arguments);
        }
        return $stringable;
    }
}