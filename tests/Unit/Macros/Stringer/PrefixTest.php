<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Stringer\Prefix;
use Stringer\Stringer;

/**
 * Prefixクラスのユニットテスト
 */
class PrefixTest extends TestCase
{
    #[Test]
    public function プレフィックスが正常に追加される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Prefix();
        
        // テスト用のStringerオブジェクトを作成
        $stringable = new Stringer('world');
        
        // プレフィックス付きの文字列を作成
        $result = $instance($stringable, 'hello ');
        
        $expected = 'hello world';
        $actual = $result->toString();
        
        $this->assertEquals($expected, $actual);
    }
    
    #[Test]
    public function プレフィックスが空文字の場合元の文字列がそのまま返される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Prefix();
        
        // テスト用のStringerオブジェクトを作成
        $stringable = new Stringer('test');
        
        // 空文字のプレフィックスで実行
        $result = $instance($stringable, '');
        
        $expected = 'test';
        $actual = $result->toString();
        
        $this->assertEquals($expected, $actual);
    }
    
    #[Test]
    public function 引数が渡されない場合デフォルト値の空文字が使用される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Prefix();
        
        // テスト用のStringerオブジェクトを作成
        $stringable = new Stringer('example');
        
        // 引数なしで実行
        $result = $instance($stringable);
        
        $expected = 'example';
        $actual = $result->toString();
        
        $this->assertEquals($expected, $actual);
    }
    
    #[Test]
    public function 戻り値がStringerインスタンスである(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Prefix();
        
        // テスト用のStringerオブジェクトを作成
        $stringable = new Stringer('test');
        
        // プレフィックス付きで実行
        $result = $instance($stringable, 'prefix_');
        
        $expected = true;
        $actual = $result instanceof Stringer;
        
        $this->assertEquals($expected, $actual);
    }
    
    #[Test]
    public function 複数の引数が渡された場合最初の引数のみが使用される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Prefix();
        
        // テスト用のStringerオブジェクトを作成
        $stringable = new Stringer('content');
        
        // 複数の引数で実行
        $result = $instance($stringable, 'first_', 'second_', 'third_');
        
        $expected = 'first_content';
        $actual = $result->toString();
        
        $this->assertEquals($expected, $actual);
    }
    
    #[Test]
    public function 特殊文字を含むプレフィックスが正常に処理される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Prefix();
        
        // テスト用のStringerオブジェクトを作成
        $stringable = new Stringer('text');
        
        // 特殊文字を含むプレフィックスで実行
        $result = $instance($stringable, '🚀 ');
        
        $expected = '🚀 text';
        $actual = $result->toString();
        
        $this->assertEquals($expected, $actual);
    }
    
    #[Test]
    public function 日本語文字を含むプレフィックスが正常に処理される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Prefix();
        
        // テスト用のStringerオブジェクトを作成
        $stringable = new Stringer('テスト');
        
        // 日本語プレフィックスで実行
        $result = $instance($stringable, '前置詞_');
        
        $expected = '前置詞_テスト';
        $actual = $result->toString();
        
        $this->assertEquals($expected, $actual);
    }
}