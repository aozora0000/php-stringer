<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Trim;
use Stringer\Stringable;
use Stringer\Stringer;

// Trimクラスのユニットテスト
class TrimTest extends TestCase
{
    #[Test]
    public function 前後のスペースが削除されることを検証する(): void
    {
        // Stringableのモックを作成
        $stringable = new Stringer(" テスト \n\t"); // 実際にはtoStringのみ使うが安全策

        $instance = new Trim();
        $actual = $instance($stringable);
        $this->assertSame('テスト', $actual->toString());
    }

    #[Test]
    public function 引数で指定された文字が削除されることを検証する(): void
    {
        $stringable = new Stringer('!!!データ!!!');

        $instance = new Trim();

        // '!' をトリム対象にする
        $actual = $instance($stringable, '!');

        $this->assertSame('データ', $actual->toString());
    }

    #[Test]
    public function 空文字列の場合も正常に動作することを検証する(): void
    {
        $stringable = new Stringer('');

        $instance = new Trim();

        $actual = $instance($stringable);

        $this->assertSame('', $actual->toString());
    }

    #[Test]
    public function 全部トリム対象の場合空文字になることを検証する(): void
    {
        $stringable = new Stringer("  \t\r\n");

        $instance = new Trim();
        $actual = $instance($stringable);

        $this->assertSame('', $actual->toString());
    }

    // 引数で指定したUnicodeトリム対象文字で動作すること
    #[Test]
    public function 指定したUnicode文字が削除されることを検証する(): void
    {
        $stringable = new Stringer('\xE2\x80\x8Bテスト\xE2\x80\x8B');

        $instance = new Trim();

        $actual = $instance($stringable, '\xE2\x80\x8B');

        $this->assertSame('テスト', $actual->toString());
    }
}