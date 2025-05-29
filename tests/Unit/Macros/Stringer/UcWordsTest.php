<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\UcWords;
use Stringer\Stringable;
use Stringer\Stringer;

class UcWordsTest extends TestCase
{
    #[Test]
    public function 単語の最初の文字を大文字に変換する(): void
    {
        // 準備
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn () =>'hello world');
        $instance = new UcWords();

        // 実行
        $actual = $instance($stringable);

        // 検証
        $this->assertEquals('Hello World', $actual->toString());
    }

    #[Test]
    public function 空文字列の場合は空文字列を返す(): void
    {
        // 準備
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn () =>'');
        $instance = new UcWords();

        // 実行
        $actual = $instance($stringable);

        // 検証
        $this->assertEquals('', $actual->toString());
    }

    #[Test]
    public function 単一単語の場合は最初の文字のみ大文字になる(): void
    {
        // 準備
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn () =>'hello');
        $instance = new UcWords();

        // 実行
        $actual = $instance($stringable);

        // 検証
        $this->assertEquals('Hello', $actual->toString());
    }

    #[Test]
    public function 複数のスペースで区切られた単語も正しく変換される(): void
    {
        // 準備
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn () =>'hello  world  test');
        $instance = new UcWords();

        // 実行
        $actual = $instance($stringable);

        // 検証
        $this->assertEquals('Hello  World  Test', $actual->toString());
    }

    #[Test]
    public function 数字が含まれた文字列も正しく処理される(): void
    {
        // 準備
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn () =>'hello123 world456');
        $instance = new UcWords();

        // 実行
        $actual = $instance($stringable);

        // 検証
        $this->assertEquals('Hello123 World456', $actual->toString());
    }

    #[Test]
    public function 戻り値はStringerインスタンスである(): void
    {
        // 準備
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn () =>'test');
        $instance = new UcWords();

        // 実行
        $actual = $instance($stringable);

        // 検証
        $this->assertInstanceOf(Stringer::class, $actual);
    }

    #[Test]
    public function 引数が渡されても正常に動作する(): void
    {
        // 準備
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn () =>'hello world');
        $instance = new UcWords();

        // 実行
        $actual = $instance($stringable, 'unused', 'arguments');

        // 検証
        $this->assertEquals('Hello World', $actual->toString());
    }
}