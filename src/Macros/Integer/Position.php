<?php

namespace Stringer\Macros\Integer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class Position implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): int | false
    {
        $needle = self::param($arguments, 0, '');
        $offset = (int)self::param($arguments, 1, 0);
        return mb_strpos($stringable->toString(), $needle, $offset);
    }
}