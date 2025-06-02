<?php

namespace Stringer\Macros\Datetime;

use Carbon\Carbon;
use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Datetime implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $format = self::param($arguments, 0, 'Y-m-d H:i:s');
        $timezone = self::param($arguments, 1, date_default_timezone_get());;
        return new Stringer(Carbon::parse($stringable->toString())->timezone($timezone)->format($format));
    }
}