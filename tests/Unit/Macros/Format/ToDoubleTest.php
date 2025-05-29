<?php

namespace Tests\Stringer\Unit\Macros\Format;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Stringable;
use Stringer\Macros\Format\ToDouble;
use InvalidArgumentException;

class ToDoubleTest extends TestCase
{
    /**
     * 数値文字列を小数点以下2桁のdouble型に変換できることを確認
     */
    #[Test]
    public function 小数点以下2桁の数値に変換できる(): void
    {
        $instance = new ToDouble();
        
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')
            ->willReturnCallback(function(string $method, array $args): Stringable|string|int|float|bool|array {
                return match($method) {
                    'isNumeric' => true,
                    'toString' => '123.456',
                };
            });
        $this->assertEqualsWithDelta(123.46, $instance($stringable, 2), PHP_FLOAT_EPSILON);
    }

    /**
     * 数値文字列をdouble型に変換できることを確認
     */
    #[Test]
    public function 数値文字列をdouble型に変換できる(): void
    {
        $instance = new ToDouble();
        
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')
            ->willReturnCallback(function(string $method, array $args): Stringable|string|int|float|bool|array {
                return match($method) {
                    'isNumeric' => true,
                    'toString' => '123.456',
                };
            });
        $this->assertEqualsWithDelta(123.456, $instance($stringable), PHP_FLOAT_EPSILON);
    }

    /**
     * 数値でない文字列の場合に例外がスローされることを確認
     */
    #[Test]
    public function 数値でない文字列の場合に例外がスローされる(): void
    {
        $toDouble = new ToDouble();
        
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')
            ->willReturnCallback(function(string $method, array $args): Stringable|string|int|float|bool|array {
                return match($method) {
                    'isNumeric' => false,
                    'toString' => 'not-a-number',
                };
            });

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot convert to double');
        
        $toDouble($stringable);
    }
}