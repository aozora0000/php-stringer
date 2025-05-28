<?php

namespace Stringer\Macros\Integer;

use Stringer\Stringable;
use Stringer\StringerCallable;

class Position implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): int | false
    {
        $needle = $arguments[0] ?? '';
        $offset = (int)($arguments[1] ?? 0);
        return mb_strpos($stringable->toString(), $needle, $offset);
    }
}