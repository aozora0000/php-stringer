<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Slugify;
use Stringer\Stringable;
use Stringer\Stringer;

/**
 * Slugクラスのユニットテスト
 */
class SlugifyTest extends TestCase
{
    /**
     * デフォルトのセパレータでスラッグが生成されることをテスト
     */
    #[Test]
    public function デフォルトのセパレータでスラッグが生成される(): void
    {
        // モックオブジェクトを作成
        $stringable = new Stringer('Hello World');

        // Slugインスタンスを作成
        $instance = new Slugify();
        
        // メソッドを実行
        $actual = $instance($stringable);

        // 結果がStringerインスタンスであることを確認
        $this->assertInstanceOf(Stringer::class, $actual);
    }

    /**
     * デフォルトのセパレータ（ハイフン）でスラッグが正しく変換されることをテスト
     */
    #[Test]
    public function デフォルトのハイフンセパレータでスラッグが正しく変換される(): void
    {
        // モックオブジェクトを作成
        $stringable = new Stringer('Hello World');

        // Slugインスタンスを作成
        $instance = new Slugify();
        
        // メソッドを実行
        $actual = $instance($stringable);

        // スラッグが正しく変換されていることを確認
        $this->assertEquals('hello-world', $actual->toString());
    }

    /**
     * カスタムセパレータでスラッグが生成されることをテスト
     */
    #[Test]
    public function カスタムセパレータでスラッグが生成される(): void
    {
        // モックオブジェクトを作成
        $stringable = new Stringer('Hello World');

        // Slugインスタンスを作成
        $instance = new Slugify();
        
        // カスタムセパレータでメソッドを実行
        $actual = $instance($stringable, '_');

        // 結果がStringerインスタンスであることを確認
        $this->assertInstanceOf(Stringer::class, $actual);
    }

    /**
     * カスタムセパレータ（アンダースコア）でスラッグが正しく変換されることをテスト
     */
    #[Test]
    public function カスタムアンダースコアセパレータでスラッグが正しく変換される(): void
    {
        // モックオブジェクトを作成
        $stringable = new Stringer('Hello World');

        // Slugインスタンスを作成
        $instance = new Slugify();
        
        // カスタムセパレータでメソッドを実行
        $actual = $instance($stringable, '_');

        // スラッグが正しく変換されていることを確認
        $this->assertEquals('hello_world', $actual->toString());
    }

    /**
     * 日本語文字列がスラッグに変換されることをテスト
     */
    #[Test]
    public function 日本語文字列がスラッグに変換される(): void
    {
        // モックオブジェクトを作成
        $stringable = new Stringer('こんにちは 世界');

        // Slugインスタンスを作成
        $instance = new Slugify();
        
        // メソッドを実行
        $actual = $instance($stringable);

        // 結果がStringerインスタンスであることを確認
        $this->assertInstanceOf(Stringer::class, $actual);
    }

    /**
     * 特殊文字を含む文字列がスラッグに変換されることをテスト
     */
    #[Test]
    public function 特殊文字を含む文字列がスラッグに変換される(): void
    {
        // モックオブジェクトを作成
        $stringable = new Stringer('Hello@World#123!');

        // Slugインスタンスを作成
        $instance = new Slugify();
        
        // メソッドを実行
        $actual = $instance($stringable);

        // 結果がStringerインスタンスであることを確認
        $this->assertInstanceOf(Stringer::class, $actual);
    }

    /**
     * 空文字列がスラッグに変換されることをテスト
     */
    #[Test]
    public function 空文字列がスラッグに変換される(): void
    {
        // モックオブジェクトを作成
        $stringable = new Stringer('');

        // Slugインスタンスを作成
        $instance = new Slugify();
        
        // メソッドを実行
        $actual = $instance($stringable);

        // 結果がStringerインスタンスであることを確認
        $this->assertInstanceOf(Stringer::class, $actual);
    }

    /**
     * 複数のセパレータ引数が渡された場合に最初の引数のみが使用されることをテスト
     */
    #[Test]
    public function 複数のセパレータ引数が渡された場合に最初の引数のみが使用される(): void
    {
        // モックオブジェクトを作成
        $stringable = new Stringer('Hello World');

        // Slugインスタンスを作成
        $instance = new Slugify();
        
        // 複数の引数でメソッドを実行
        $actual = $instance($stringable, '_', '-', '.');

        // アンダースコアセパレータが使用されていることを確認
        $this->assertEquals('hello_world', $actual->toString());
    }
}