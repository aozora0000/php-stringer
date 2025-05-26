<?php

namespace Tests\Stringer\Unit\Macros\Format;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Format\ToBinary;
use Stringer\Stringable;
use InvalidArgumentException;
use Stringer\Stringer;

class ToBinaryTest extends TestCase
{
    /**
     * 整数値を2進数文字列に変換できることを確認
     */
    #[Test]
    public function 整数を2進数に変換できる(): void
    {
        $instance = new ToBinary();
        $stringable = $this->createMock(Stringer::class);
        $stringable->method('__call')->willReturnCallback(function(string $name, array $arguments): Stringable|string|int|float|bool {
            return match($name) {
                'isInteger' => true,
                'toString' => '42',
            };
        });
        $this->assertSame('101010', $instance($stringable));
    }

    /**
     * 非整数値の場合に例外がスローされることを確認
     */
    #[Test]
    public function 非整数の場合に例外がスローされる(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot convert to binary');

        $instance = new ToBinary();
        $stringable = $this->createMock(Stringer::class);
        $stringable->method('__call')->willReturnCallback(function(string $name, array $arguments): Stringable|string|int|float|bool {
            return match($name) {
                'isInteger' => false,
            };
        });

        $instance($stringable);
    }

    /**
     * 0を2進数に変換できることを確認
     */
    #[Test]
    public function ゼロを2進数に変換できる(): void
    {
        $instance = new ToBinary();
        $stringable = $this->createMock(Stringer::class);
        $stringable->method('__call')->willReturnCallback(function(string $name, array $arguments): Stringable|string|int|float|bool {
            return match($name) {
                'isInteger' => true,
                'toString' => '0',
            };
        });
        $this->assertSame('0', $instance($stringable));
    }
}