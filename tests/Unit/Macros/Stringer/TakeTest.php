<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Take;
use Stringer\Stringer;

class TakeTest extends TestCase
{
    #[Test]
    public function 正の値を指定した場合は先頭から指定された文字数を取得する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Take();
        $stringable = new Stringer('Hello World');
        
        // 実行
        $actual = $instance($stringable, '5');
        
        // 検証
        $this->assertEquals('Hello', $actual->toString());
    }
    
    #[Test]
    public function 負の値を指定した場合は末尾から指定された文字数を取得する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Take();
        $stringable = new Stringer('Hello World');
        
        // 実行
        $actual = $instance($stringable, '-5');
        
        // 検証
        $this->assertEquals('World', $actual->toString());
    }
    
    #[Test]
    public function ゼロを指定した場合は空文字を返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Take();
        $stringable = new Stringer('Hello World');
        
        // 実行
        $actual = $instance($stringable, '0');
        
        // 検証
        $this->assertEquals('', $actual->toString());
    }
    
    #[Test]
    public function 引数が指定されなかった場合はデフォルト値の1が使用される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Take();
        $stringable = new Stringer('Hello World');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertEquals('H', $actual->toString());
    }
    
    #[Test]
    public function 文字列の長さより大きな値を指定した場合は文字列全体を返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Take();
        $stringable = new Stringer('Hello');
        
        // 実行
        $actual = $instance($stringable, '10');
        
        // 検証
        $this->assertEquals('Hello', $actual->toString());
    }
    
    #[Test]
    public function 文字列の長さより大きな負の値を指定した場合は文字列全体を返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Take();
        $stringable = new Stringer('Hello');
        
        // 実行
        $actual = $instance($stringable, '-10');
        
        // 検証
        $this->assertEquals('Hello', $actual->toString());
    }
    
    #[Test]
    public function 空文字列に対して正の値を指定した場合は空文字列を返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Take();
        $stringable = new Stringer('');
        
        // 実行
        $actual = $instance($stringable, '5');
        
        // 検証
        $this->assertEquals('', $actual->toString());
    }
    
    #[Test]
    public function 空文字列に対して負の値を指定した場合は空文字列を返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Take();
        $stringable = new Stringer('');
        
        // 実行
        $actual = $instance($stringable, '-5');
        
        // 検証
        $this->assertEquals('', $actual->toString());
    }
}