<?php

namespace Stringer\Macros\Stringer;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;
use voku\helper\ASCII;

class Slugify implements StringerCallable
{
    use Helper;
    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $sep = self::param($arguments, 0, '-');
        $language = self::param($arguments, 1, 'en');
        return new Stringer(ASCII::to_slugify($stringable->toString(), $sep, $language));
    }
}