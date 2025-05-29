<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Replace implements StringerCallable
{
    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        $pattern = $arguments[0] ?? '';
        if(!is_array($pattern) && Stringer::create($arguments[0] ?? '')->isRegexPattern()) {
            return new Stringer(preg_replace($arguments[0] ?? '', $arguments[1] ?? '', $stringable->toString()));
        }

        return new Stringer(str_replace($arguments[0] ?? '', $arguments[1] ?? '', $stringable->toString()));
    }
}