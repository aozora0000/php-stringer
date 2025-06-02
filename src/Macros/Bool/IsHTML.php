<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class IsHTML implements StringerCallable
{
    use Helper;
    public const START_TAGS = '!DOCTYPE|html|head|title|body|div|p|a|span|table|form|input|script|link|meta|img';

    public const CLOSING_TAGS = 'html|head|title|body|div|p|a|span|table|form|script';

    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        $startTags = self::param($arguments, 0, self::START_TAGS);
        $closingTags = self::param($arguments, 0, self::CLOSING_TAGS);
        $pattern = '/<(?:' . $startTags . ')[^>]*>|<\/(?:' . $closingTags . ')>/i';
        return $stringable->isMatch($pattern);
    }
}