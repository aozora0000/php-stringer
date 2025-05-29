<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Title implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        return new Stringer(mb_convert_case($stringable->toString(), MB_CASE_TITLE, 'UTF-8'));
    }
}