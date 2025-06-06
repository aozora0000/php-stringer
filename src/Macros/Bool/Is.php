<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class Is implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        $param = self::param($arguments, 0);
        return hash_equals($stringable->toString(), $param);
    }
}