<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Ltrim implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): Stringer
    {
        $arguments = array_filter($arguments);
        return new Stringer(ltrim($stringable->toString(), $arguments[0] ?? " \n\r\t\v\0"));
    }
}