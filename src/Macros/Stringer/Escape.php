<?php

namespace Stringer\Macros\Stringer;

use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Helpers\HtmlEscaper;
use Stringer\Helpers\SqlEscaper;
use Stringer\Stringable;
use Stringer\StringerCallable;

class Escape implements StringerCallable
{
    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        $type = $arguments[0] ?? 'html';
        if(!is_string($type)) {
            throw new InvalidArgumentException("Escape type must be a string");
        }
        $arguments = array_slice($arguments, 1);
        return match(true) {
            $type === 'html' => HtmlEscaper::html($stringable, ...$arguments),
            $type === 'url' => HtmlEscaper::url($stringable, ...$arguments),
            $type === 'sql' => SqlEscaper::sanitize($stringable),
            default => throw new InvalidArgumentException("Invalid escape type: $type. Must be one of: html, url, sql"),
        };
    }
}