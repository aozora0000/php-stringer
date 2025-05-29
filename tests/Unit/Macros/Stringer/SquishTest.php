<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Squish;
use Stringer\Stringer;

class SquishTest extends TestCase
{
    #[Test]
    public function 通常の複数スペースを単一スペースに変換する(): void
    {
        // 準備
        $instance = new Squish();
        $stringable = new Stringer('  hello    world  ');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('hello world', $actual->toString());
    }

    #[Test]
    public function 先頭と末尾の空白を削除する(): void
    {
        // 準備
        $instance = new Squish();
        $stringable = new Stringer('  hello world  ');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('hello world', $actual->toString());
    }

    #[Test]
    public function タブ文字を単一スペースに変換する(): void
    {
        // 準備
        $instance = new Squish();
        $stringable = new Stringer("hello\t\tworld");
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('hello world', $actual->toString());
    }

    #[Test]
    public function 改行文字を単一スペースに変換する(): void
    {
        // 準備
        $instance = new Squish();
        $stringable = new Stringer("hello\n\nworld");
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('hello world', $actual->toString());
    }

    #[Test]
    public function 韓国語のハングルフィラー文字を単一スペースに変換する(): void
    {
        // 準備
        $instance = new Squish();
        $stringable = new Stringer("hello\u{3164}\u{3164}world");
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('hello world', $actual->toString());
    }

    #[Test]
    public function 韓国語のハングル中性文字を単一スペースに変換する(): void
    {
        // 準備
        $instance = new Squish();
        $stringable = new Stringer("hello\u{1160}\u{1160}world");
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('hello world', $actual->toString());
    }

    #[Test]
    public function 空文字列の場合は空文字列を返す(): void
    {
        // 準備
        $instance = new Squish();
        $stringable = new Stringer('');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('', $actual->toString());
    }

    #[Test]
    public function スペースのみの文字列の場合は空文字列を返す(): void
    {
        // 準備
        $instance = new Squish();
        $stringable = new Stringer('   ');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('', $actual->toString());
    }

    #[Test]
    public function 混合した空白文字を単一スペースに変換する(): void
    {
        // 準備
        $instance = new Squish();
        $stringable = new Stringer("  hello \t\n world  ");
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('hello world', $actual->toString());
    }

    #[Test]
    public function 追加引数が渡されても処理に影響しない(): void
    {
        // 準備
        $instance = new Squish();
        $stringable = new Stringer('  hello    world  ');
        
        // 実行
        $actual = $instance($stringable, 'extra', 'arguments');
        
        // 検証
        $this->assertSame('hello world', $actual->toString());
    }
}