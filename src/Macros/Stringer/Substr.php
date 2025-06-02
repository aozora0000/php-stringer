<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Substr implements StringerCallable
{
    use Helper;

    /**
     * @param int ...$arguments
     * @return Stringer
     */
    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        $start = self::param($arguments, 0, 0);
        $length = self::param($arguments, 1, null);
        return new Stringer(mb_substr($stringable, $start, $length));
    }
}