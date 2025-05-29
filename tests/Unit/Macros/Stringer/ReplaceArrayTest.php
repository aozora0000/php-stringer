<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\ReplaceArray;
use Stringer\Stringable;
use Stringer\Stringer;

/**
 * ReplaceArrayクラスのユニットテスト
 */
class ReplaceArrayTest extends TestCase
{
    #[Test]
    public function 検索文字列が見つからない場合は元の文字列をそのまま返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new ReplaceArray();
        
        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('hello world');
        
        // 実行
        $actual = $instance($stringable, 'xyz', ['replacement']);
        
        // 検証：元の文字列がそのまま返されることを確認
        $this->assertEquals('hello world', $actual->toString());
    }

    #[Test]
    public function 単一の検索文字列を単一の置換文字列で置き換える(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new ReplaceArray();
        
        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('hello world hello');
        
        // 実行
        $actual = $instance($stringable, 'hello', ['hi']);
        
        // 検証：最初の出現のみが置換されることを確認
        $this->assertEquals('hi world hello', $actual->toString());
    }

    #[Test]
    public function 複数の置換文字列がある場合は順番に使用される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new ReplaceArray();
        
        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('hello world hello universe hello');
        
        // 実行
        $actual = $instance($stringable, 'hello', ['hi', 'hey']);
        
        // 検証：置換文字列が順番に使用されることを確認
        $this->assertEquals('hi world hey universe hello', $actual->toString());
    }

    #[Test]
    public function 置換文字列が足りない場合は検索文字列がそのまま使用される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new ReplaceArray();
        
        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('hello world hello universe hello');
        
        // 実行
        $actual = $instance($stringable, 'hello', ['hi']);
        
        // 検証：置換文字列が足りない場合は検索文字列が使用されることを確認
        $this->assertEquals('hi world hello universe hello', $actual->toString());
    }

    #[Test]
    public function 引数が空の場合は適切にデフォルト値が使用される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new ReplaceArray();
        
        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('test string');
        
        // 実行（引数なし）
        $actual = $instance($stringable);
        
        // 検証：元の文字列がそのまま返されることを確認
        $this->assertEquals('test string', $actual->toString());
    }

    #[Test]
    public function 戻り値がStringerインスタンスであることを確認(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new ReplaceArray();
        
        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('test');
        
        // 実行
        $actual = $instance($stringable, 'search', ['replace']);
        
        // 検証：戻り値がStringerクラスのインスタンスであることを確認
        $this->assertInstanceOf(Stringer::class, $actual);
    }

    #[Test]
    public function 空文字列の場合の処理を確認(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new ReplaceArray();
        
        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('');
        
        // 実行
        $actual = $instance($stringable, 'search', ['replace']);
        
        // 検証：空文字列がそのまま返されることを確認
        $this->assertEquals('', $actual->toString());
    }

    #[Test]
    public function 検索文字列が文字列の先頭にある場合の処理を確認(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new ReplaceArray();
        
        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('hello world');
        
        // 実行
        $actual = $instance($stringable, 'hello', ['hi']);
        
        // 検証：先頭の検索文字列が正しく置換されることを確認
        $this->assertEquals('hi world', $actual->toString());
    }

    #[Test]
    public function 検索文字列が文字列の末尾にある場合の処理を確認(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new ReplaceArray();
        
        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('world hello');
        
        // 実行
        $actual = $instance($stringable, 'hello', ['hi']);
        
        // 検証：末尾の検索文字列が正しく置換されることを確認
        $this->assertEquals('world hi', $actual->toString());
    }
}