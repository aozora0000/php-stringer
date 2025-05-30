<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class IsEmail implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        if(!$stringable->isContains('@')) {
            return false;
        }
        [, $host] = $stringable->split('@');
        if(is_null($host) || $host->isEmpty()) {
            return false;
        }
        $callback = fn(string $type) => checkdnsrr($host, $type);
        return
            filter_var($stringable->toString(), FILTER_VALIDATE_EMAIL) !== false &&
            self::some($callback, ['MX', 'A', 'AAAA']);
    }
}