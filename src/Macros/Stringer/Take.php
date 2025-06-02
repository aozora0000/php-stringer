<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class Take implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $limit = self::param($arguments, 0, 1);
        if ($limit < 0) {
            return $stringable->substr($limit);
        }

        return $stringable->substr(0, $limit);
    }
}