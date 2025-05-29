<?php

namespace Tests\Stringer\Unit\Macros\Format;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Format\ToBase64;
use Stringer\Stringer;

/**
 * ToBase64クラスのユニットテストクラス
 */
class ToBase64Test extends TestCase
{
    #[Test]
    public function 通常の文字列をBase64エンコードできる(): void
    {
        // 準備
        $instance = new ToBase64();
        $stringable = new Stringer('Hello World');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('SGVsbG8gV29ybGQ=', $actual);
    }

    #[Test]
    public function 空文字列をBase64エンコードできる(): void
    {
        // 準備
        $instance = new ToBase64();
        $stringable = new Stringer('');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('', $actual);
    }

    #[Test]
    public function 日本語文字列をBase64エンコードできる(): void
    {
        // 準備
        $instance = new ToBase64();
        $stringable = new Stringer('こんにちは');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('44GT44KT44Gr44Gh44Gv', $actual);
    }

    #[Test]
    public function 数字を含む文字列をBase64エンコードできる(): void
    {
        // 準備
        $instance = new ToBase64();
        $stringable = new Stringer('test123');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('dGVzdDEyMw==', $actual);
    }

    #[Test]
    public function 特殊文字を含む文字列をBase64エンコードできる(): void
    {
        // 準備
        $instance = new ToBase64();
        $stringable = new Stringer('!@#$%^&*()');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('IUAjJCVeJiooKQ==', $actual);
    }

    #[Test]
    public function 改行文字を含む文字列をBase64エンコードできる(): void
    {
        // 準備
        $instance = new ToBase64();
        $stringable = new Stringer("line1\nline2");
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertSame('bGluZTEKbGluZTI=', $actual);
    }

    #[Test]
    public function 追加引数が渡されても正常にBase64エンコードできる(): void
    {
        // 準備
        $instance = new ToBase64();
        $stringable = new Stringer('test');
        
        // 実行
        $actual = $instance($stringable, 'unused', 'arguments');
        
        // 検証
        $this->assertSame('dGVzdA==', $actual);
    }
}