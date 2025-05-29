<?php

namespace Stringer\Macros\Stringer;

use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Hash implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, ...$arguments): Stringer
    {
        $hasher = $arguments[0] ?? 'sha1';
        $arguments = array_slice($arguments, 1);
        return new Stringer(match(true) {
            is_string($hasher) && function_exists($hasher) => $hasher($stringable->toString(), ...$arguments),
            is_string($hasher) && in_array($hasher, hash_algos()) => hash($hasher, $stringable->toString(), ...$arguments),
            is_string($hasher) && self::is_class_method_string($hasher) => call_user_func_array($hasher, [$stringable->toString(), ...$arguments]),
            is_callable($hasher) => $hasher($stringable->toString(), ...$arguments),
            default => throw new InvalidArgumentException('Invalid hasher'),
        });
    }
}