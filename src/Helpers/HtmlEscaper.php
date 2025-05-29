<?php

namespace Stringer\Helpers;

use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Stringable;
use Stringer\Stringer;

class HtmlEscaper
{
    public static function html(Stringable $stringer, int $flag = ENT_QUOTES | ENT_HTML5, string $encoding = 'UTF-8'): Stringable
    {
        return $stringer
            ->callback(fn(Stringer $stringer) => htmlspecialchars($stringer->toString(), $flag, $encoding));
    }

    public static function url(Stringable $stringer, array $protocol = ['http', 'https', 'ftp', 'mailto']): Stringable
    {
        if (!$stringer->isMatch('/^' . implode('|', $protocol) . ':\/\//i')) {
            throw new InvalidArgumentException('Invalid protocol');
        }
        return $stringer
            ->trim()
            ->replace([' ', "\t", "\n", "\r"], '')
            ->callback(fn(Stringer $stringer) => new Stringer(html_entity_decode($stringer, ENT_QUOTES | ENT_HTML5, 'UTF-8')))
            ->replace('#(?<!:)//+#', '/');
    }
}