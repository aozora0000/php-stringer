<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Ltrim implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $arguments = array_filter($arguments);
        $chars = self::param($arguments, 0, " \n\r\t\v\0");
        return new Stringer(ltrim($stringable->toString(), $chars));
    }
}