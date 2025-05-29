<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Concat;
use Stringer\Stringable;
use Stringer\Stringer;

/**
 * Concatクラスの単体テスト
 */
class ConcatTest extends TestCase
{
    #[Test]
    public function 空配列の場合の戻り値(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => 'abc');

        $instance = new Concat();
        $actual = $instance($stringable);

        // Stringerインスタンスであることを確認
        $this->assertSame('abc', $actual->toString());
    }

    #[Test]
    public function 引数を連結することを確認(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => 'foo');

        $instance = new Concat();
        $actual = $instance($stringable, 'bar', 'baz');

        $this->assertSame('foobarbaz', (string)$actual);
    }

    #[Test]
    public function 空文字列は連結されないこと(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => 'xxx');

        $instance = new Concat();
        $actual = $instance($stringable, '', 'yyy');

        // 空文字列は無視され"xxxyyy"になること
        $this->assertSame('xxxyyy', (string)$actual);
    }
}