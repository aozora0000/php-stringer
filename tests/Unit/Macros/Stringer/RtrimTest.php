<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Rtrim;
use Stringer\Stringable;
use Stringer\Stringer;

/**
 * Rtrimクラスのユニットテスト
 */
class RtrimTest extends TestCase
{
    #[Test]
    public function 空白が除去されることを確認する(): void
    {
        $stringable = new Stringer("テスト　\r\n ");

        $instance = new Rtrim();
        $actual = $instance($stringable);

        $this->assertSame('テスト', $actual->toString());
    }

    #[Test]
    public function 引数指定の文字が除去されることを確認する(): void
    {
        $stringable = new Stringer("xxテストxx");

        $instance = new Rtrim();
        $actual = $instance($stringable, 'x');

        $this->assertSame('xxテスト', $actual->toString());
    }

    #[Test]
    public function 引数なしでデフォルト動作になることを確認する(): void
    {
        $stringable = new Stringer("abc　 \r\n\t");

        $instance = new Rtrim();
        $actual = $instance($stringable);

        $this->assertSame('abc', $actual->toString());
    }
}