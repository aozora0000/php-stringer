<?php

namespace Stringer\Macros\Datetime;

use Carbon\Carbon;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Datetime implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $format = $arguments[0] ?? 'Y-m-d H:i:s';
        $timezone = $arguments[1] ?? date_default_timezone_get();
        return new Stringer(Carbon::parse($stringable->toString())->timezone($timezone)->format($format));
    }
}