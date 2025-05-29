<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Rtrim;
use Stringer\Stringable;

/**
 * Rtrimクラスのユニットテスト
 */
class RtrimTest extends TestCase
{
    #[Test]
    public function 空白が除去されることを確認する(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => "テスト　\r\n ");

        $instance = new Rtrim();
        $actual = $instance($stringable);

        $this->assertSame('テスト', $actual->toString());
    }

    #[Test]
    public function 引数指定の文字が除去されることを確認する(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => "xxテストxx");

        $instance = new Rtrim();
        $actual = $instance($stringable, 'x');

        $this->assertSame('xxテスト', $actual->toString());
    }

    #[Test]
    public function 引数なしでデフォルト動作になることを確認する(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => "abc　 \r\n\t");

        $instance = new Rtrim();
        $actual = $instance($stringable);

        $this->assertSame('abc', $actual->toString());
    }
}