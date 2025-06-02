<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class Unwrap implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $prefix = self::param($arguments, 0, '');
        $postfix = self::param($arguments, 1,  $prefix);
        return $stringable->ltrim($prefix)->rtrim($postfix);
    }
}