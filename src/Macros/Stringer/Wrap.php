<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Wrap implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $prefix = self::param($arguments, 0, '');
        $postfix = self::param($arguments, 1,  $prefix);
        return new Stringer(implode('', [$prefix, $stringable->toString(), $postfix]));
    }
}