<?php

namespace Stringer\Macros\Datetime;

use Carbon\Carbon;
use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Timestamp implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $timezone = self::param($arguments, 0, date_default_timezone_get());;
        return new Stringer(Carbon::parse($stringable->toString())->timezone($timezone)->timestamp);
    }
}