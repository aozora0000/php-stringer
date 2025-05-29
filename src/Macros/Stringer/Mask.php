<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class Mask implements StringerCallable
{

    public function __invoke(Stringable $stringable, string ...$arguments): Stringable
    {
        $character = $arguments[0] ?? '*';
        $index = $arguments[1] ?? 0;
        $length = $arguments[2] ?? null;

        $segment = $stringable->substr($index, $length);

        if ($segment->isEmpty()) {
            return $stringable;
        }

        $strlen = $stringable->length();
        $startIndex = $index;

        if ($index < 0) {
            $startIndex = $index < -$strlen ? 0 : $strlen + $index;
        }

        $start = $stringable->substr(0, $startIndex)->toString();
        $segmentLen = $segment->length();
        $mask = str_repeat(mb_substr($character, 0, 1), $segmentLen);
        $end = $stringable->substr($startIndex + $segmentLen)->toString();

        return new Stringer($start . $mask . $end);
    }
}