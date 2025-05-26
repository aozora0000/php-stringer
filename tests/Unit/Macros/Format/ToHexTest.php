<?php

namespace Tests\Stringer\Unit\Macros\Format;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Format\ToHex;
use Stringer\Stringable;
use InvalidArgumentException;

class ToHexTest extends TestCase
{
    /**
     * 整数値を16進数に変換できることを確認
     */
    #[Test]
    public function 整数を十六進数に変換できる(): void
    {
        // テスト対象のクラスをインスタンス化
        $instance = new ToHex();
        
        // Stringableのモックを作成
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')
            ->willReturnCallback(function (string $method, array $args) {
                return match ($method) {
                    'isInteger' => true,
                    'toString' => '255',
                    default => null,
                };
            });

        // 実行と検証
        $this->assertSame('ff', $instance($stringable));
    }

    /**
     * 整数以外の値が渡された場合に例外がスローされることを確認
     */
    #[Test]
    public function 整数以外の値の場合は例外がスローされる(): void
    {
        // テスト対象のクラスをインスタンス化
        $instance = new ToHex();
        
        // Stringableのモックを作成
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')
            ->willReturnCallback(function (string $method, array $args) {
                return match ($method) {
                    'isInteger' => false,
                    default => null,
                };
            });

        // 例外の検証
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot convert to hex');
        
        $instance($stringable);
    }
}