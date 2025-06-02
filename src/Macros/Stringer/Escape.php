<?php

namespace Stringer\Macros\Stringer;

use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Helper;
use Stringer\Helpers\HtmlEscaper;
use Stringer\Helpers\SqlEscaper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class Escape implements StringerCallable
{
    use Helper;

    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        $type = self::param($arguments, 0, 'html');
        if(!is_string($type)) {
            throw new InvalidArgumentException("Escape type must be a string");
        }

        $arguments = array_slice($arguments, 1);
        return match(true) {
            $type === 'html' => HtmlEscaper::html($stringable, ...$arguments),
            $type === 'url' => HtmlEscaper::url($stringable, ...$arguments),
            $type === 'sql' => SqlEscaper::sanitize($stringable),
            default => throw new InvalidArgumentException(sprintf('Invalid escape type: %s. Must be one of: html, url, sql', $type)),
        };
    }
}