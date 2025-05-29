<?php

namespace Tests\Stringer\Unit\Helpers;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Helpers\SqlEscaper;
use Stringer\Stringer;

/**
 * SqlEscaperクラスのテスト
 */
class SqlEscaperTest extends TestCase
{

    #[Test]
    public function 危険なSQLキーワードが除去されること_EXECUTE(): void
    {
        $result = SqlEscaper::sanitize(new Stringer('EXECUTE procedure'));
        $this->assertSame(' procedure', (string)$result);
    }

    #[Test]
    public function 危険なSQLコメントが除去されること_ダブルハイフン(): void
    {
        $result = SqlEscaper::sanitize(new Stringer('test -- comment'));
        $this->assertSame('test  comment', (string)$result);
    }

    #[Test]
    public function 危険なSQLコメントが除去されること_ブロックコメント開始(): void
    {
        $result = SqlEscaper::sanitize(new Stringer('test /* comment'));
        $this->assertSame('test  comment', (string)$result);
    }

    #[Test]
    public function 危険なSQLコメントが除去されること_ブロックコメント終了(): void
    {
        $result = SqlEscaper::sanitize(new Stringer('comment */ test'));
        $this->assertSame('comment  test', (string)$result);
    }
}