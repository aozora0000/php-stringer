<?php

namespace Stringer\Macros\Integer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class Length implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): int
    {
        $offset = (int)self::param($arguments, 0, 0);
        $substring = mb_substr($stringable->toString(), $offset);
        return match(true) {
            $stringable->isEmpty(), mb_strlen($stringable->toString(), 'UTF-8') < $offset => 0,
            default => mb_strlen($substring, 'UTF-8'),
        };
    }
}