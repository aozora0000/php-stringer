<?php

namespace Stringer\Macros\Datetime;

use Carbon\Carbon;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Timestamp implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): Stringer
    {
        return new Stringer(Carbon::parse($stringable->toString())->timestamp);
    }
}