<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class IsIPv4 implements StringerCallable
{
    use Helper;

    public const IPV4_PATTERN = '/^(?:(?:25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(?:25[0-5]|2[0-4]\d|[01]?\d\d?)$/';

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        return $stringable->isMatch(self::IPV4_PATTERN);
    }
}