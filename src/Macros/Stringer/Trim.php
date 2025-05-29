<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Trim implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $arguments = array_filter($arguments);
        return new Stringer(trim($stringable->toString(), $arguments[0] ?? " \n\r\t\v\0"));
    }
}