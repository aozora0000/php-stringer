<?php

namespace Stringer\Macros\Misc;

use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Stringable;
use Stringer\StringerCallable;

class Then implements StringerCallable
{

    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        if(!isset($arguments[0]) || !is_callable($arguments[0])) {
            throw new InvalidArgumentException("First Argument Then requires a callable");
        }

        if(!isset($arguments[1]) || !is_callable($arguments[1])) {
            throw new InvalidArgumentException("Second Argument Then requires a callable");
        }

        if($arguments[0]($stringable)) {
            return $arguments[1]($stringable);
        }

        return $stringable;
    }
}