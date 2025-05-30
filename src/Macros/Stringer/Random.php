<?php

namespace Stringer\Macros\Stringer;

use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Random implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $length = $arguments[0] ?? 10;
        $chars = array_unique($stringable->replace('/\s+/', '')->split('//u'));
        if($chars === []) {
            throw new InvalidArgumentException("Random requires at least one character to generate a random string from.");
        }
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[array_rand($chars)];
        }
        return new Stringer($result);
    }
}