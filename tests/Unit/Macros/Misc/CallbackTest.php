<?php

namespace Tests\Stringer\Unit\Macros\Misc;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Misc\Callback;
use Stringer\Stringable;
use Stringer\Stringer;

class CallbackTest extends TestCase
{
    #[Test]
    public function コールバック関数が渡された場合にStringerオブジェクトを返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Callback();

        // Stringableオブジェクトを作成
        $stringable = new Stringer('test');

        // コールバック関数を定義（文字列を大文字に変換）
        $callback = function ($value) {
            return strtoupper((string)$value);
        };

        // テスト実行
        $actual = $instance($stringable, $callback);

        // 結果がStringerインスタンスであることを確認
        $this->assertInstanceOf(Stringer::class, $actual);
    }

    #[Test]
    public function コールバック関数が渡された場合にコールバック関数の結果が適用される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Callback();

        // Stringableオブジェクトを作成
        $stringable = new Stringer('hello');

        // コールバック関数を定義（文字列を大文字に変換）
        $callback = function ($value) {
            return strtoupper((string)$value);
        };

        // テスト実行
        $actual = $instance($stringable, $callback);

        // 結果の文字列が期待値と一致することを確認
        $this->assertSame('HELLO', (string)$actual);
    }

    #[Test]
    public function 引数が渡されない場合に元のStringableオブジェクトを返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Callback();

        // Stringableオブジェクトを作成
        $stringable = new Stringer('test');

        // テスト実行（引数なし）
        $actual = $instance($stringable);

        // 元のオブジェクトがそのまま返されることを確認
        $this->assertSame($stringable, $actual);
    }

    #[Test]
    public function 第一引数がnullの場合に元のStringableオブジェクトを返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Callback();

        // Stringableオブジェクトを作成
        $stringable = new Stringer('test');

        // テスト実行（第一引数がnull）
        $actual = $instance($stringable, null);

        // 元のオブジェクトがそのまま返されることを確認
        $this->assertSame($stringable, $actual);
    }

    #[Test]
    public function 第一引数がfalseの場合に元のStringableオブジェクトを返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Callback();

        // Stringableオブジェクトを作成
        $stringable = new Stringer('test');

        // テスト実行（第一引数がfalse）
        $actual = $instance($stringable, false);

        // 元のオブジェクトがそのまま返されることを確認
        $this->assertSame($stringable, $actual);
    }

    #[Test]
    public function 第一引数がコールバル関数でない場合に元のStringableオブジェクトを返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Callback();

        // Stringableオブジェクトを作成
        $stringable = new Stringer('test');

        // テスト実行（第一引数が文字列）
        $actual = $instance($stringable, 'not_callable');

        // 元のオブジェクトがそのまま返されることを確認
        $this->assertSame($stringable, $actual);
    }

    #[Test]
    public function クロージャーが渡された場合に正しく処理される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Callback();

        // Stringableオブジェクトを作成
        $stringable = new Stringer('world');

        // クロージャーを定義
        $callback = function (string $value): string {
            return 'Hello, ' . $value . '!';
        };

        // テスト実行
        $actual = $instance($stringable, $callback);

        // 結果が期待値と一致することを確認
        $this->assertSame('Hello, world!', (string)$actual);
    }

    #[Test]
    public function 文字列関数名が渡された場合に正しく処理される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Callback();

        // Stringableオブジェクトを作成
        $stringable = new Stringer('test string');

        // テスト実行（strlenを文字列で渡す）
        $actual = $instance($stringable, 'strlen');

        // 結果が期待値と一致することを確認（文字列長が返される）
        $this->assertSame('11', (string)$actual);
    }
}