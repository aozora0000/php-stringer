<?php

namespace Stringer;

interface StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): mixed;
}