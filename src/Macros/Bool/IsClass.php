<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class IsClass implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        $namespace = self::param($arguments, 0, '');
        if($namespace === '') {
            return class_exists($stringable);
        }

        return class_exists(implode('', [
            '\\' , ltrim($namespace) , '\\' , ltrim($stringable)
        ]));
    }
}