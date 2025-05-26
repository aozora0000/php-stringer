<?php

namespace Stringer\Macros\Stringer;

use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Sprintf implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringer
    {
        if($arguments === []) {
            throw new InvalidArgumentException("Sprintf requires at least one argument");
        }

        return new Stringer(vsprintf($arguments[0], [$stringable->toString(), ...array_slice($arguments, 1)]));
    }
}