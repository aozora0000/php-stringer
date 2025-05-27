<?php

namespace Stringer\Macros\Stringer;

use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class PregReplace implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): mixed
    {
        if(count($arguments) < 2) {
            throw new InvalidArgumentException("PregReplace requires at least two arguments, the pattern and the replacement");
        }
        return new Stringer(preg_replace(
            $arguments[0],
            $arguments[1],
            $stringable->toString(),
            $arguments[2] ?? -1,
        ));
    }
}