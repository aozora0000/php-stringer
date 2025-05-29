<?php

namespace Stringer\Macros\Bool;

use Carbon\Carbon;
use Stringer\Stringable;
use Stringer\StringerCallable;

class IsDatetime implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        if($stringable->isEmpty()) {
            return false;
        }
        try {
            Carbon::parse($stringable->toString());
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}