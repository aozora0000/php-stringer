<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Repeat;
use Stringer\Stringer;

class RepeatTest extends TestCase
{


    #[Test]
    public function 繰り返し結果の文字列が正しく生成される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Repeat();

        // Stringableのモックを作成
        $stringable = new Stringer('abc');

        // テスト実行
        $actual = $instance($stringable, '2');

        // アサーション
        $this->assertEquals('abcabc', $actual->toString());
    }

    #[Test]
    public function 引数が指定されない場合はデフォルトで1回繰り返される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Repeat();

        // Stringableのモックを作成
        $stringable = new Stringer('hello');

        // テスト実行
        $actual = $instance($stringable);

        // アサーション
        $this->assertEquals('hello', $actual->toString());
    }

    #[Test]
    public function ゼロ回繰り返すと元の文字列が返される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Repeat();

        // Stringableのモックを作成
        $stringable = new Stringer('hello');

        // テスト実行
        $actual = $instance($stringable, 0);

        // アサーション
        $this->assertEquals('', $actual->toString());
    }

    #[Test]
    public function 空文字列を繰り返すと空文字列が返される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Repeat();

        // Stringableのモックを作成
        $stringable = new Stringer('');

        // テスト実行
        $actual = $instance($stringable, '5');

        // アサーション
        $this->assertEquals('', $actual->toString());
    }

    #[Test]
    public function 一文字を複数回繰り返すことができる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Repeat();

        // Stringableのモックを作成
        $stringable = new Stringer('x');

        // テスト実行
        $actual = $instance($stringable, '4');

        // アサーション
        $this->assertEquals('xxxx', $actual->toString());
    }
}