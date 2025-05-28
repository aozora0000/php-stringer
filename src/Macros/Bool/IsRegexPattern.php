<?php

namespace Stringer\Macros\Bool;

use Stringer\Stringable;
use Stringer\StringerCallable;

class IsRegexPattern implements StringerCallable
{
    public function __invoke(Stringable $stringable, string ...$arguments): bool
    {
        // 最低3文字以上で開始・終了が同じデリミタ
        if ($stringable->isMatch('#^(.)(.*)\\1[imsxuADSUXJu]*$#')) {
            // 正規表現として利用可能か試す
            set_error_handler(function() {}, E_WARNING); // 警告を一時抑制
            $result = preg_match($stringable->toString(), "");
            restore_error_handler();
            return $result !== false;
        }
        return false;
    }
}