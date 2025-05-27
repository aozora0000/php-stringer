<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsJson implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        try {
            json_decode($stringable->toString(), true, 512, JSON_THROW_ON_ERROR);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}