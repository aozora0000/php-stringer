<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsHTML implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        $tags = $arguments[0] ?? '!DOCTYPE|html|head|title|body|div|p|a|span|table|form|input|script|link|meta|img';
        $closingTags = $arguments[0] ?? 'html|head|title|body|div|p|a|span|table|form|script';
        $pattern = '/<(?:' . $tags . ')[^>]*>|<\/(?:' . $closingTags . ')>/i';
        return (bool)preg_match($pattern, $stringable->toString());
    }
}