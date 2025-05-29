<?php

namespace Stringer\Macros\Stringer;

use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Basename implements StringerCallable
{

    public function __invoke(Stringable $stringable,  ...$arguments): Stringable
    {
        if($stringable->isEmpty()) {
            throw new InvalidArgumentException('String is empty');
        }
        return new Stringer(basename(str_replace('\\', '/', $stringable->toString())));
    }
}