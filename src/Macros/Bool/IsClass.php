<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsClass implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        return class_exists((string)$stringable);
    }
}