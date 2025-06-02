<?php

namespace Stringer\Macros\Integer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class Count implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): int
    {
        $needle = self::param($arguments, 0);
        return match(true) {
            $stringable->isEmpty(), is_null($needle) => 0,
            default => mb_substr_count($stringable->toString(), $needle),
        };
    }
}