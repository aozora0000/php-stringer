<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Prefix implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $prefix = self::param($arguments, 0, '');
        return new Stringer($prefix . $stringable->toString());
    }
}