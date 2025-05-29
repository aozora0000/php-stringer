<?php

namespace Stringer\Helpers;

use Stringer\Stringable;

class SqlEscaper
{

    /**
     * SQLインジェクション対策の基本的なサニタイズ
     */
    public static function sanitize(Stringable $stringable): Stringable
    {
        // 危険なSQL キーワードを除去
        $dangerous = [
            'EXECUTE', 'execute', 'EXEC', 'exec', '--', '/*', '*/'
        ];
        return $stringable
            ->replace($dangerous, '')
            ->replace(['\\', "\0", "\n", "\r", "\x1a", "'", '"'], ['\\\\', '\\0', '\\n', '\\r', '\\Z', "\\'", '\\"']);
    }
}