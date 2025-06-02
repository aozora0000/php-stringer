<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class IsClassMethod implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        $sep = self::param($arguments, 0, '::');
        $namespace = self::param($arguments, 1, '');
        if(!$stringable->isContains($sep)) {
            return false;
        }

        [$class, $method] = explode($sep, $stringable);
        return class_exists($namespace . $class) && method_exists($namespace . $class, $method);
    }
}