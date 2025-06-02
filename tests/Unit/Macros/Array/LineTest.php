<?php

namespace Tests\Stringer\Unit\Macros\Array;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Array\Line;
use Stringer\Stringer;

class LineTest extends TestCase
{
    #[Test]
    public function 単一行の文字列を分割すると配列の要素が一つになる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Line();
        
        // 単一行の文字列でStringerオブジェクトを作成
        $stringable = new Stringer('こんにちは');
        
        // テスト実行
        $actual = $instance($stringable);
        $expected = ['こんにちは'];
        $toLine = fn(Stringer $stringable): string => $stringable->toString();
        // アサーション
        $this->assertSame($expected, array_map($toLine, $actual) );
    }

    #[Test]
    public function 複数行の文字列を分割すると各行が配列の要素になる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Line();
        
        // 複数行の文字列でStringerオブジェクトを作成
        $stringable = new Stringer("第一行\n第二行\n第三行");
        
        // テスト実行
        $actual = $instance($stringable);
        
        // アサーション
        $this->assertCount(3, $actual);
    }

    #[Test]
    public function 空文字列を分割すると空文字列の空配列要素になる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Line();
        
        // 空文字列でStringerオブジェクトを作成
        $stringable = new Stringer('');
        
        // テスト実行
        $actual = $instance($stringable);
        $expected = [];
        
        // アサーション
        $this->assertSame($expected, $actual);
    }

    #[Test]
    public function 改行のみの文字列を分割すると空配列になる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Line();
        
        // 改行のみの文字列でStringerオブジェクトを作成
        $stringable = new Stringer("\n");
        
        // テスト実行
        $actual = $instance($stringable);
        $expected = [];
        
        // アサーション
        $this->assertSame($expected, $actual);
    }

    #[Test]
    public function 末尾に改行がある文字列を分割すると最後に空文字列の要素が追加される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Line();
        
        // 末尾に改行がある文字列でStringerオブジェクトを作成
        $stringable = new Stringer("第一行\n第二行\n");
        
        // テスト実行
        $actual = $instance($stringable);

        // アサーション
        $this->assertCount(3, $actual);
    }

    #[Test]
    public function 連続する改行がある文字列を分割すると間に空文字列の要素が挿入される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Line();
        
        // 連続する改行がある文字列でStringerオブジェクトを作成
        $stringable = new Stringer("第一行\n\n第三行");
        
        // テスト実行
        $actual = $instance($stringable);

        // アサーション
        $this->assertCount(3, $actual);
    }
}