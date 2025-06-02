<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Repeat implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        $times = self::param($arguments, 0, 1);
        return new Stringer(str_repeat($stringable->toString(), $times));
    }
}