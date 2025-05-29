<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Ltrim;
use Stringer\Stringable;

/**
 * Ltrimクラスのユニットテスト
 */
class LtrimTest extends TestCase
{
    /**
     * 引数で指定した文字だけを左側からトリムすることを確認する
     */
    #[Test]
    public function 左側の特定の文字のみ除去されること(): void
    {
        // StringableをモックしてtoStringで値を返すようにする
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn(string $method, array $args): Stringable|string|int|float|bool|array => 'xxABCxx');

        $instance = new Ltrim();
        $actual = $instance($stringable, 'x');
        
        // 期待される値 "ABCxx" であることを確認する
        $this->assertSame('ABCxx', $actual->toString());
    }

    /**
     * 引数によるトリム指定がない場合、標準的な空白と制御文字が除去されること
     */
    #[Test]
    public function デフォルトで空白や制御文字が除去されること(): void
    {
        // StringableをモックしてtoStringで値を返すようにする
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn(string $method, array $args): Stringable|string|int|float|bool|array => "\t\r\nABC ");

        $instance = new Ltrim();
        $actual = $instance($stringable);
        
        // 期待される値 "ABC " であることを確認する
        $this->assertSame('ABC ', $actual->toString());
    }

    /**
     * 引数の配列で複数文字を指定したとき、一番最初の指定だけが使われること
     */
    #[Test]
    public function 複数引数指定で先頭のみ利用されること(): void
    {
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')->willReturnCallback(fn(string $method, array $args): Stringable|string|int|float|bool|array => 'aabbcc');

        $instance = new Ltrim();
        $actual = $instance($stringable, 'a', 'b');
        
        // 'a'のみトリムされ'b'は影響しないことを確認
        $this->assertSame('bbcc', $actual->toString());
    }
}