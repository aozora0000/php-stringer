<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Rtrim implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringer
    {
        $arguments = array_filter($arguments);
        return new Stringer(rtrim($stringable->toString(), $arguments[0] ?? "　 \n\r\t\v\0"));
    }
}