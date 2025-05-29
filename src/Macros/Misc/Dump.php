<?php

namespace Stringer\Macros\Misc;

use Symfony\Component\VarDumper\VarDumper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Dump implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        if(function_exists('dump') && class_exists(VarDumper::class)) {
            dump($stringable->toString(), $arguments);
        }

        return $stringable;
    }
}