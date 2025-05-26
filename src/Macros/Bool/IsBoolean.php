<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsBoolean implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        return match(strtolower($stringable->toString())) {
            'true', 'false', '0', '1' => true,
            default => false,
        };
    }
}