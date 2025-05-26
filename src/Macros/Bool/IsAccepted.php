<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsAccepted implements StringerCallable
{
    public static array $accepted = [
        'yes', 'y', 'true', '1', 'on', 'enabled', 'ok', 'accept' ,'accepted', '同意', '同意する'
    ];

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        return in_array($stringable->toString(), array_merge(self::$accepted, $arguments));
    }
}