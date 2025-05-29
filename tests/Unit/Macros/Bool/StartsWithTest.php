<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\StartsWith;
use Stringer\Stringable;

class StartsWithTest extends TestCase
{
    /**
     * 空文字の場合は常にfalseを返すことを確認する
     */
    #[Test]
    public function 空文字の場合はfalseを返す(): void
    {
        // Stringableのモックを作成し、toString()が空文字を返すよう設定
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => '');

        $startsWith = new StartsWith();

        $this->assertFalse($startsWith($stringable, 'a'));
    }

    /**
     * 引数が空配列の場合はfalseを返すことを確認する
     */
    #[Test]
    public function 引数が空配列の場合はfalseを返す(): void
    {
        // Stringableのモックを作成し、toString()が "apple" を返すよう設定
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn(): Stringable|string|int|float|bool|array => 'apple');

        $startsWith = new StartsWith();

        $this->assertFalse($startsWith($stringable));
    }

    /**
     * 1つだけ引数を与えた場合に、先頭一致する場合trueを返すことを確認する
     */
    #[Test]
    public function 先頭が一致した場合はtrueを返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => 'banana');

        $startsWith = new StartsWith();

        $this->assertTrue($startsWith($stringable, 'ban'));
    }

    /**
     * 1つだけ引数を与えた場合に、先頭一致しない場合falseを返すことを確認する
     */
    #[Test]
    public function 先頭が一致しない場合はfalseを返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => 'banana');

        $startsWith = new StartsWith();

        $this->assertFalse($startsWith($stringable, 'apple'));
    }

    /**
     * 複数の引数の中にどれか一致する場合trueを返すことを確認する
     */
    #[Test]
    public function 複数の中で一致する値があればtrueを返す(): void
    {
        // some()メソッドを利用して結果がtrueになるパターン
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => 'orange');
        $instance = new StartsWith();

        $this->assertTrue($instance($stringable, 'banana', 'or', 'app'));
    }

    /**
     * 複数の引数の中に一致するものがなければfalseを返すことを確認する
     */
    #[Test]
    public function 複数の中で一致する値がなければfalseを返す(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn (): Stringable|string|int|float|bool|array => 'remon');;
        $instance = new StartsWith();

        $this->assertFalse($instance($stringable, 'apple', 'ba', 'or'));
    }
}