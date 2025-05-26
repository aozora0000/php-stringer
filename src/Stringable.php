<?php

namespace Stringer;

use ReflectionException;

interface Stringable extends \Stringable
{
    /**
     * @throws ReflectionException
     */
    public function __call(string $name, array $arguments): Stringable|string|int|float|bool|array;
}