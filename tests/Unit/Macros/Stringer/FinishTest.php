<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Finish;
use Stringer\Stringable;
use Stringer\Stringer;

class FinishTest extends TestCase
{
    /**
     * 文字列の末尾から指定した文字列が削除され、その後1つだけ付加されることを検証する
     */
    #[Test]
    public function 末尾の文字列が1つでも複数でもキャップ文字列で終わる場合に末尾が1つだけ残る(): void
    {
        $stingable = new Stringer('foobarbar');

        $instance = new Finish();
        $actual = $instance($stingable, 'bar');
        // Stringerオブジェクトで "foobar" の末尾に "bar" が1つ付加されている事
        $this->assertEquals('foobar', $actual->toString());
    }

    /**
     * 末尾にキャップ文字列が存在しない場合でも1つだけ追加されることを検証する
     */
    #[Test]
    public function 末尾にキャップ文字列が存在しない場合にキャップが追加される(): void
    {
        $stingable = new Stringer('foo');

        $instance = new Finish();
        $actual = $instance($stingable, 'bar');
        $this->assertEquals('foobar', $actual->toString());
    }

    /**
     * キャップ文字列が空の場合、元の文字列がそのまま返ることを検証する
     */
    #[Test]
    public function キャップ文字列が空の場合は元の文字列を返す(): void
    {
        $stingable = new Stringer('foo');

        $instance = new Finish();
        $actual = $instance($stingable, '');
        $this->assertEquals('foo', $actual->toString());
    }
}