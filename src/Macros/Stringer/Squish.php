<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\StringerCallable;

class Squish implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        return $stringable->trim()->replace('~(\s|\x{3164}|\x{1160})+~u', ' ');
    }
}