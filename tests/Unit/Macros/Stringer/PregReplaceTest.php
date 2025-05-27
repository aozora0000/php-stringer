<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Macros\Stringer\PregReplace;
use Stringer\Stringable;

class PregReplaceTest extends TestCase
{
    // 正しいパターンと置換により新しいStringerが返ることを検証
    #[Test]
    public function パターン置換で文字列が変更される()
    {
        // Stringableのモック作成
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn()=> 'abc123def');

        $instance = new PregReplace();
        $actual = $instance($stringable, '/\d+/', 'X');
        // 期待される結果の確認
        $this->assertEquals('abcXdef', $actual->toString());
    }

    // 3つめの引数(最大置換回数)が指定できることを検証
    #[Test]
    public function 最大回数を指定してパターン置換できる()
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn () => '111 222 333');

        $instance = new PregReplace();
        $actual = $instance($stringable, '/\d+/', '-', 1);
        $this->assertEquals('- 222 333', $actual->toString());
    }

    // 引数が不足している場合に例外が投げられることを検証
    #[Test]
    public function 引数が足りない場合例外が投げられる()
    {
        $this->expectException(InvalidArgumentException::class);

        $stringable = $this->createMock(Stringable::class);
        $instance = new PregReplace();
        $instance($stringable, '/a/');
    }
}