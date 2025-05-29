<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Remove;
use Stringer\Stringable;
use Stringer\Stringer;

/**
 * Removeクラスのユニットテスト
 */
class RemoveTest extends TestCase
{
    #[Test]
    public function 指定した文字列を削除できる(): void
    {
        // 準備
        $instance = new Remove();
        $stringable = new Stringer('Hello world!');

        // 実行
        $actual = $instance($stringable, 'world');

        // 検証
        $this->assertSame('Hello !', (string) $actual);
    }

    #[Test]
    public function 引数が空の場合は空文字で置換される(): void
    {
        // 準備
        $instance = new Remove();
        $stringable = new Stringer('Hello world!');

        // 実行
        $actual = $instance($stringable);

        // 検証
        $this->assertSame('Hello world!', (string) $actual);
    }

    #[Test]
    public function 複数の引数が渡された場合は最初の引数のみ使用される(): void
    {
        // 準備
        $instance = new Remove();
        $stringable = new Stringer('first second third');

        // 実行
        $actual = $instance($stringable, 'first', 'second', 'third');

        // 検証
        $this->assertSame(' second third', (string) $actual);
    }

    #[Test]
    public function Stringableインターフェースを実装したオブジェクトを返す(): void
    {
        // 準備
        $instance = new Remove();
        $stringable = new Stringer('test');

        // 実行
        $actual = $instance($stringable, 'test');

        // 検証
        $this->assertInstanceOf(Stringable::class, $actual);
    }

    #[Test]
    public function 存在しない文字列を指定した場合は元の文字列が返される(): void
    {
        // 準備
        $instance = new Remove();
        $stringable = new Stringer('Hello world!');

        // 実行
        $actual = $instance($stringable, 'xyz');

        // 検証
        $this->assertSame('Hello world!', (string) $actual);
    }

    #[Test]
    public function 空の文字列から文字列を削除しても空のまま(): void
    {
        // 準備
        $instance = new Remove();
        $stringable = new Stringer('');

        // 実行
        $actual = $instance($stringable, 'test');

        // 検証
        $this->assertSame('', (string) $actual);
    }
}