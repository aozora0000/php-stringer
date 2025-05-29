<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Stringer\Postfix;
use Stringer\Stringer;

/**
 * Postfixクラスのユニットテストクラス
 */
class PostfixTest extends TestCase
{
    #[Test]
    public function 接尾辞を追加できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Postfix();
        
        // 元の文字列と追加する接尾辞を準備
        $stringable = new Stringer('hello');
        $postfix = 'world';
        
        // メソッドを実行
        $actual = $instance->__invoke($stringable, $postfix);
        $expected = 'helloworld';
        
        // 結果を検証
        $this->assertSame($expected, $actual->toString());
    }
    
    #[Test]
    public function 空文字の接尾辞を追加できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Postfix();
        
        // 元の文字列と空の接尾辞を準備
        $stringable = new Stringer('test');
        $postfix = '';
        
        // メソッドを実行
        $actual = $instance->__invoke($stringable, $postfix);
        $expected = 'test';
        
        // 結果を検証
        $this->assertSame($expected, $actual->toString());
    }
    
    #[Test]
    public function 引数なしでも動作する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Postfix();
        
        // 元の文字列のみを準備（引数なし）
        $stringable = new Stringer('original');
        
        // メソッドを実行（引数なし）
        $actual = $instance->__invoke($stringable);
        $expected = 'original';
        
        // 結果を検証
        $this->assertSame($expected, $actual->toString());
    }
    
    #[Test]
    public function 複数の引数がある場合は最初の引数のみを使用する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Postfix();
        
        // 元の文字列と複数の引数を準備
        $stringable = new Stringer('base');
        $firstPostfix = 'first';
        $secondPostfix = 'second';
        
        // メソッドを実行（複数の引数）
        $actual = $instance->__invoke($stringable, $firstPostfix, $secondPostfix);
        $expected = 'basefirst';
        
        // 結果を検証
        $this->assertSame($expected, $actual->toString());
    }
    
    #[Test]
    public function 戻り値がStringerインスタンスである(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Postfix();
        
        // 元の文字列と接尾辞を準備
        $stringable = new Stringer('test');
        $postfix = 'suffix';
        
        // メソッドを実行
        $actual = $instance->__invoke($stringable, $postfix);
        $expected = Stringer::class;
        
        // 戻り値の型を検証
        $this->assertInstanceOf($expected, $actual);
    }
    
    #[Test]
    public function 空文字列に接尾辞を追加できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Postfix();
        
        // 空文字列と接尾辞を準備
        $stringable = new Stringer('');
        $postfix = 'added';
        
        // メソッドを実行
        $actual = $instance->__invoke($stringable, $postfix);
        $expected = 'added';
        
        // 結果を検証
        $this->assertSame($expected, $actual->toString());
    }
}