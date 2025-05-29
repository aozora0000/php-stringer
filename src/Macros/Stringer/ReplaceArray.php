<?php

namespace Stringer\Macros\Stringer;

use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class ReplaceArray implements StringerCallable
{

    public function __invoke(Stringable $stringable, ...$arguments): Stringable
    {
        $search = $arguments[0] ?? '';
        $replace = $arguments[1] ?? [];
        if($search === '' || empty($replace)) {
            return $stringable;
        }
        $segments = explode($search, $stringable->toString());

        $result = array_shift($segments);

        foreach ($segments as $segment) {
            $result .= (array_shift($replace) ?? $search) . $segment;
        }

        return new Stringer($result);
    }
}