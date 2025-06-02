<?php

namespace Stringer\Macros\Bool;

use Stringer\Helper;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\StringerCallable;

class IsDirectory implements StringerCallable
{
    use Helper;
    
    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        if($stringable->ltrim('/')->isEmpty()) {
            return false;
        }

        $root_dir = new Stringer(self::param($arguments, 0, ''));
        $path = implode('', [$root_dir->rtrim('/'), '/', $stringable->ltrim('/')]);
        return is_readable($path) && is_dir($path);
    }
}