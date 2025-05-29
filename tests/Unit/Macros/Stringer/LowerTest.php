<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Stringer\Lower;
use Stringer\Stringable;
use Stringer\Stringer;

class LowerTest extends TestCase
{
    /**
     * 大文字の文字列を小文字に変換できることを確認
     */
    #[Test]
    public function 大文字から小文字への変換(): void
    {
        // テスト対象のインスタンスを作成
        $lower = new Lower();

        // モックの作成と設定
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(): Stringable|string|int|float|bool|array => 'HELLO');

        // テスト実行
        $result = $lower($stringable);

        // 検証
        $this->assertInstanceOf(Stringer::class, $result);
        $this->assertEquals('hello', $result->toString());
    }

    /**
     * 空文字列を処理できることを確認
     */
    #[Test]
    public function 空文字列の処理(): void
    {
        // テスト対象のインスタンスを作成
        $lower = new Lower();

        // モックの作成と設定
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(): Stringable|string|int|float|bool|array => '');

        // テスト実行
        $result = $lower($stringable);

        // 検証
        $this->assertEquals('', $result->toString());
    }
}