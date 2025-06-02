<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Finish implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $cap = self::param($arguments, 0, '');
        return new Stringer(preg_replace(
                '/(?:' . preg_quote($cap, '/') . ')+$/u',
                '',
                $stringable->toString()
            ) . $cap);
    }
}