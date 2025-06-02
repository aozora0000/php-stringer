<?php

namespace Tests\Stringer\Unit\Macros\Format;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Format\ToInteger;
use Stringer\Stringable;
use Stringer\Stringer;

class ToIntegerTest extends TestCase
{
    /**
     * 数値文字列が正しく整数に変換されることを確認
     */
    #[Test]
    public function 数値文字列を整数に変換できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new ToInteger();
        
        // Stringableのモックを作成
        $stringable = new Stringer("123");
            
        // 検証
        $this->assertSame(123, $instance($stringable));
    }

    /**
     * 整数に変換できない文字列の場合に例外がスローされることを確認
     */
    #[Test]
    public function 整数に変換できない場合は例外をスロー(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new ToInteger();
        
        // Stringableのモックを作成
        $stringable = new Stringer("aaa");

        // 例外が発生することを期待
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot convert to integer');
        
        // 実行
        $instance($stringable);
    }
}