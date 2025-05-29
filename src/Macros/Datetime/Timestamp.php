<?php

namespace Stringer\Macros\Datetime;

use Carbon\Carbon;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Timestamp implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $timezone = $arguments[0] ?? date_default_timezone_get();
        return new Stringer(Carbon::parse($stringable->toString())->timezone($timezone)->timestamp);
    }
}