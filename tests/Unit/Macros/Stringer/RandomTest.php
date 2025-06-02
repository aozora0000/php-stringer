<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Random;
use Stringer\Stringer;

class RandomTest extends TestCase
{
    #[Test]
    public function 引数なしでデフォルト長10の文字列を生成する(): void
    {
        $instance = new Random();
        $stringable = new Stringer('abc');

        $actual = $instance($stringable);
        $expected = 10;

        $this->assertSame($expected, strlen($actual->toString()));
    }

    #[Test]
    public function 指定した長さの文字列を生成する(): void
    {
        $instance = new Random();
        $stringable = new Stringer('abc');

        $actual = $instance($stringable, '5');
        $expected = 5;

        $this->assertSame($expected, strlen($actual->toString()));
    }

    #[Test]
    public function 空白文字が除去された文字セットから生成する(): void
    {
        $instance = new Random();
        $stringable = new Stringer('a b c');

        $actual = $instance($stringable, '10');

        // 空白文字が含まれていないことを確認
        $this->assertStringNotContainsString(' ', $actual->toString());
    }

    #[Test]
    public function 重複文字が除去された文字セットから生成する(): void
    {
        $instance = new Random();
        $stringable = new Stringer('aabbcc');

        $actual = $instance($stringable, '10');

        // 生成された文字列の各文字が元の文字セット内に含まれることを確認
        $chars = str_split($actual->toString());
        $allowedChars = ['a', 'b', 'c'];
        foreach ($chars as $char) {
            $this->assertContains($char, $allowedChars);
        }
    }

    #[Test]
    public function Stringerインスタンスを返す(): void
    {
        $instance = new Random();
        $stringable = new Stringer('abc');

        $actual = $instance($stringable);

        $this->assertInstanceOf(Stringer::class, $actual);
    }

    #[Test]
    public function 長さ0を指定した場合空文字列を生成する(): void
    {
        $instance = new Random();
        $stringable = new Stringer('abc');

        $actual = $instance($stringable, '0');
        $expected = '';

        $this->assertEquals($expected, $actual->toString());
    }

    #[Test]
    public function 単一文字から指定長の文字列を生成する(): void
    {
        $instance = new Random();
        $stringable = new Stringer('x');

        $actual = $instance($stringable, '3');
        $expected = 'xxx';

        $this->assertEquals($expected, $actual->toString());
    }

    #[Test]
    public function 空文字を指定した場合例外が発生する(): void
    {
        $instance = new Random();
        $stringable = new Stringer('');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Random requires at least one character to generate a random string from.');
        $instance($stringable);
    }
}