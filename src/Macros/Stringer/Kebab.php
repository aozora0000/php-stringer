<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Kebab implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        return $stringable->replace(['_'], '-')->snake('-');
    }
}