<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\IsRegexPattern;
use Stringer\Stringable;

class IsRegexPatternTest extends TestCase
{
    /** 正しい正規表現パターン（例：'/abc/'）はtrueを返すべき */
    #[Test]
    public function 正規表現の場合は真を返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => '/abc/');

        $instance = new IsRegexPattern();
        $this->assertTrue($instance($stringable));
    }

    /** デリミタが異なる文字列（例：'/abc['）はfalseを返すべき */
    #[Test]
    public function デリミタが不正な場合は偽を返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => '/abc[');

        $instance = new IsRegexPattern();
        $this->assertFalse($instance($stringable));
    }

    /** 正規表現のデリミタが1文字未満（例：'ab'）はfalseを返すべき */
    #[Test]
    public function デリミタが1文字未満の場合は偽を返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => 'ab');

        $instance = new IsRegexPattern();
        $this->assertFalse($instance($stringable));
    }

    /** 末尾に修飾子付き正規表現（例：'/abc/i'）はtrueを返すべき */
    #[Test]
    public function 修飾子付き正規表現は真を返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => '/abc/i');

        $instance = new IsRegexPattern();
        $this->assertTrue($instance($stringable));
    }

    /** 不正な正規表現構文（例：'/[abc'）はfalseを返すべき */
    #[Test]
    public function 不正な正規表現構文の場合は偽を返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn(): Stringable|string|int|float|bool|array => '/[abc');

        $instance = new IsRegexPattern();
        $this->assertFalse($instance($stringable));
    }
}