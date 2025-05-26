<?php

namespace Stringer\Macros\Format;

use Stringer\Stringable;
use Stringer\StringerCallable;

class ToString implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): string
    {
        return (string)$stringable;
    }
}