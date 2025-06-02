<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class IsEqual implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        return hash_equals($stringable->toString(), self::param($arguments, 0, ''));
    }
}