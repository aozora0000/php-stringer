<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;
use voku\helper\ASCII;

class Slugify implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        return new Stringer(ASCII::to_slugify($stringable->toString(), $arguments[0] ?? '-', $arguments[1] ?? 'en'));
    }
}