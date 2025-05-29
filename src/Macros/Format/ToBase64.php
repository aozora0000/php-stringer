<?php

namespace Stringer\Macros\Format;

use Stringer\Stringable;
use Stringer\StringerCallable;

class ToBase64 implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): string
    {
        return base64_encode($stringable->toString());
    }
}