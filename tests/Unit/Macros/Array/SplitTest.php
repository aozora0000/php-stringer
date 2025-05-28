<?php

namespace Tests\Stringer\Unit\Macros\Array;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Array\Split;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class SplitTest extends TestCase
{
    /**
     * デフォルトのセパレータ（カンマ）で文字列を分割するテスト
     */
    #[Test]
    public function デフォルトセパレータで分割できる(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn() => 'a,b,c');
        
        $instance = new Split();
        
        $actual = $instance($stringable);
        
        $this->assertCount(3, $actual);
        $this->assertEquals('a', $actual[0]->toString());

        $this->assertEquals('b', $actual[1]->toString());

        $this->assertEquals('c', $actual[2]->toString());

    }

    /**
     * カスタムセパレータを使用して文字列を分割するテスト
     */
    #[Test]
    public function カスタムセパレータで分割できる(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn() => 'a|b|c');
        
        $instance = new Split();
        
        $actual = $instance($stringable, '|');
        
        $this->assertCount(3, $actual);
    }

    #[Test]
    public function 正規表現パターンの場合に正規表現分割が使われる(): void
    {
        // 準備
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn() => 'a1b2c');;

        $instance = new Split();

        // 実行
        $actual = $instance($stringable, '/\d/');

        // 検証
        $this->assertCount(3, $actual);
        $this->assertEquals('a', $actual[0]->toString());

        $this->assertEquals('b', $actual[1]->toString());

        $this->assertEquals('c', $actual[2]->toString());
    }
    
    /**
     * 空の文字列を分割した場合に空の配列が返されることをテスト
     */
    #[Test]
    public function 空文字列を分割すると空配列が返される(): void
    {
        // 準備
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn() => '');
        
        $instance = new Split();
        
        // 実行
        $actual = $instance($stringable);

        // 検証
        $this->assertEmpty($actual);
    }
}