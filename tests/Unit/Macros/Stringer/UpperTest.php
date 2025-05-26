<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Upper;
use Stringer\Stringable;
use Stringer\Stringer;

class UpperTest extends TestCase
{
    /**
     * 小文字の文字列が大文字に変換されることを確認
     */
    #[Test]
    public function 小文字から大文字への変換()
    {
        // テスト対象のインスタンスを作成
        $upper = new Upper();

        // Stringableモックを作成
        $stringableMock = $this->createMock(Stringable::class);
        $stringableMock->method('__call')
            ->willReturnCallback(fn() => 'hello');

        // テスト実行
        $result = $upper($stringableMock);

        // 検証
        $this->assertEquals(new Stringer('HELLO'), $result);
    }

    /**
     * 日本語文字列が正しく大文字に変換されることを確認
     */
    #[Test]
    public function 日本語混じりの文字列の変換()
    {
        // テスト対象のインスタンスを作成
        $upper = new Upper();

        // Stringableモックを作成
        $stringableMock = $this->createMock(Stringable::class);
        $stringableMock->method('__call')
            ->willReturnCallback(fn() => 'こんにちはworld');

        // テスト実行
        $result = $upper($stringableMock);

        // 検証
        $this->assertEquals(new Stringer('こんにちはWORLD'), $result);
    }

    /**
     * すでに大文字の文字列を処理した場合も同じ結果となることを確認
     */
    #[Test]
    public function 大文字の文字列をそのまま変換()
    {
        // テスト対象のインスタンスを作成
        $upper = new Upper();

        // Stringableモックを作成
        $stringableMock = $this->createMock(Stringable::class);
        $stringableMock->method('__call')
            ->willReturnCallback(fn() => 'HELLO');

        // テスト実行
        $result = $upper($stringableMock);

        // 検証
        $this->assertEquals(new Stringer('HELLO'), $result);
    }
}