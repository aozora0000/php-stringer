<?php

namespace Stringer\Macros\Array;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class Line implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): array
    {
        $delimiter = self::param($arguments, 0, PHP_EOL);
        return $stringable->split($delimiter, true);
    }
}