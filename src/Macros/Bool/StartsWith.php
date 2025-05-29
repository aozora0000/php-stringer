<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class StartsWith implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        $c = fn($argument): bool  => str_starts_with($stringable->toString(), $argument);
        return match(true) {
            $stringable->toString() === '' => false,
            $arguments === [] => false,
            count($arguments) === 1 => $c($arguments[0]),
            static::some($c, $arguments) => true,
            default => false,
        };
    }
}