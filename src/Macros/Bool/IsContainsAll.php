<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class IsContainsAll implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        $c = fn($argument): bool  => str_contains($stringable->toString(), $argument);
        return match(true) {
            $stringable->toString() === '' => false,
            $arguments === [] => false,
            count($arguments) === 1 => $c($arguments[0]),
            static::every($c, $arguments) => true,
            default => false,
        };
    }
}