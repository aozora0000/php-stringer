<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\IsMatch;
use Stringer\Stringable;

class IsMatchTest extends TestCase
{
    // 正規表現にマッチする場合、1が返ることを確認する
    #[Test]
    public function 正規表現が一致する場合は1を返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => 'abc123');

        $instance = new IsMatch();
        $actual = $instance($stringable, '/\d+/');

        $this->assertTrue($actual);
    }

    // 正規表現にマッチしない場合、0が返ることを確認する
    #[Test]
    public function 正規表現が一致しない場合は0を返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn(): Stringable|string|int|float|bool|array => 'abcdef');

        $instance = new IsMatch();
        $actual = $instance($stringable, '/\d+/');

        $this->assertFalse($actual);
    }

    // パターンが空文字の場合、falseが返ることを確認する
    #[Test]
    public function パターンが空文字の場合falseを返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn(): Stringable|string|int|float|bool|array => 'abcdef');

        $instance = new IsMatch();
        $actual = $instance($stringable, '');

        $this->assertFalse($actual);
    }

    // 第二引数未指定の場合、falseが返ることを確認する
    #[Test]
    public function 第二引数未指定の場合falseを返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn(): Stringable|string|int|float|bool|array => 'abcdef');

        $instance = new IsMatch();
        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }
}