<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsClassMethod implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        $sep = $arguments[0] ?? '::';
        if(!$stringable->isContains($sep)) {
            return false;
        }
        [$class, $method] = explode($sep, $stringable);
        return class_exists($class) && method_exists($class, $method);
    }
}