<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Reverse;
use Stringer\Stringable;
use Stringer\Stringer;

class ReverseTest extends TestCase
{
    #[Test]
    public function 通常の文字列が正しく反転される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Reverse();

        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('hello');

        // メソッドを実行
        $actual = $instance($stringable);

        // 結果が期待値と一致することを確認
        $this->assertEquals('olleh', $actual->toString());
    }

    #[Test]
    public function 空文字列が正しく処理される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Reverse();

        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('');

        // メソッドを実行
        $actual = $instance($stringable);

        // 結果が期待値と一致することを確認
        $this->assertEquals('', $actual->toString());
    }

    #[Test]
    public function 一文字の文字列が正しく処理される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Reverse();

        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('a');

        // メソッドを実行
        $actual = $instance($stringable);

        // 結果が期待値と一致することを確認
        $this->assertEquals('a', $actual->toString());
    }

    #[Test]
    public function 数字を含む文字列が正しく反転される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Reverse();

        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('abc123');

        // メソッドを実行
        $actual = $instance($stringable);

        // 結果が期待値と一致することを確認
        $this->assertEquals('321cba', $actual->toString());
    }

    #[Test]
    public function 特殊文字を含む文字列が正しく反転される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Reverse();

        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('hello!@#');

        // メソッドを実行
        $actual = $instance($stringable);

        // 結果が期待値と一致することを確認
        $this->assertEquals('#@!olleh', $actual->toString());
    }

    #[Test]
    public function 戻り値がStringerインスタンスである(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Reverse();

        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('test');

        // メソッドを実行
        $actual = $instance($stringable);

        // 戻り値がStringerインスタンスであることを確認
        $this->assertInstanceOf(Stringer::class, $actual);
    }

    #[Test]
    public function 追加引数があっても正常に動作する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Reverse();

        // モックのStringableオブジェクトを作成
        $stringable = new Stringer('test');

        // メソッドを実行
        $actual = $instance($stringable, 'a', 'b');

        // 結果が期待値と一致することを確認（追加引数は無視される）
        $this->assertEquals('tset', $actual->toString());
    }
}