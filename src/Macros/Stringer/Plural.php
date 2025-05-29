<?php

namespace Stringer\Macros\Stringer;

use ICanBoogie\Inflector;
use Stringer\Cache;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Plural implements StringerCallable
{
    use Cache;

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        /** @var Inflector $inflector */
        $inflector = $this->whenKey('Inflector', fn(): Inflector => Inflector::get(Inflector::DEFAULT_LOCALE));
        return $this->when($stringable, $arguments, fn(): Stringer => new Stringer($inflector->pluralize($stringable->toString())));
    }
}