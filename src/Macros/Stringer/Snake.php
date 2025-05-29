<?php

namespace Stringer\Macros\Stringer;

use Stringer\Cache;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Snake implements StringerCallable
{
    use Cache;
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        return $this->when($stringable, $arguments,
            fn() => ctype_lower($stringable->toString()) ?
                $stringable :
                $stringable
                    ->ucwords()
                    ->replace('/\s+/u', '')
                    ->replace('/(.)(?=[A-Z])/u', '$1'.($arguments[0] ?? '_'))
                    ->lower()
        );
    }
}