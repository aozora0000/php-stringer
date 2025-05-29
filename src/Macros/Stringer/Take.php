<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\StringerCallable;

class Take implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $limit = $arguments[0] ?? 0;
        if ($limit < 0) {
            return $stringable->substr($limit);
        }
        return $stringable->substr(0, $limit);
    }
}