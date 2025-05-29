<?php

namespace Stringer\Macros\Stringer;

use ICanBoogie\Inflector;
use Stringer\Cache;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Singular implements StringerCallable
{
    use Cache;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        /** @var Inflector $inflector */
        $inflector = $this->whenKey('Inflector', fn() => Inflector::get(Inflector::DEFAULT_LOCALE));
        return $this->when($stringable, $arguments, fn() => new Stringer($inflector->singularize($stringable->toString())));
    }
}