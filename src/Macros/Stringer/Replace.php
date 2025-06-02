<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Replace implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        $pattern = self::param($arguments, 0, '');
        $replacement = self::param($arguments, 1, '');
        if (!is_array($pattern) && Stringer::create($pattern)->isRegexPattern()) {
            return new Stringer(preg_replace($pattern, $replacement, $stringable->toString()));
        }

        return new Stringer(str_replace($pattern, $replacement, $stringable->toString()));
    }
}