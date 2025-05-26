<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\EndsWith;
use Stringer\Stringable;

/**
 * EndsWith クラスのユニットテスト
 */
class EndsWithTest extends TestCase
{
    /**
     * 文字列が空文字のときに false を返すことを確認する
     */
    #[Test]
    public function 空文字列の場合はfalseになる()
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn() => '');
        $instance = new EndsWith();
        $actual = $instance($stringable, 'abc');
        $this->assertFalse($actual);
    }

    /**
     * 引数の配列が空のときに false を返すことを確認する
     */
    #[Test]
    public function 終了文字列引数が空の場合はfalseになる()
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn() => 'abc');
        $instance = new EndsWith();
        $actual = $instance($stringable);
        $this->assertFalse($actual);
    }

    /**
     * 1つだけ渡した終了文字列に一致すれば true を返すことを確認する
     */
    #[Test]
    public function １つの終了文字に一致すればtrueになる()
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn() => 'foobar');
        $instance = new EndsWith();
        $actual = $instance($stringable, 'bar');
        $this->assertTrue($actual);
    }

    /**
     * 1つだけ渡した終了文字列に一致しない場合 false を返すことを確認する
     */
    #[Test]
    public function １つの終了文字に一致しなければfalseになる()
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn() => 'foobar');
        $instance = new EndsWith();
        $actual = $instance($stringable, 'baz');
        $this->assertFalse($actual);
    }

    /**
     * 複数渡した終了文字列のいずれかに一致すれば true を返すことを確認する
     */
    #[Test]
    public function 複数の終了文字のいずれかに一致すればtrueになる()
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn() => 'foobar');
        $instance = new EndsWith();

        $actual = $instance($stringable, 'baz', 'bar', 'hoge');
        $this->assertTrue($actual);
    }

    /**
     * 複数渡した終了文字列のどれにも一致しない場合 false を返すことを確認する
     */
    #[Test]
    public function 複数の終了文字にどれも一致しなければfalseになる()
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn() => 'foobar');
        $instance = new EndsWith();

        $actual = $instance($stringable, 'abc', 'xyz', 'hoge');
        $this->assertFalse($actual);
    }
}