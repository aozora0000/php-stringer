<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Stringer;

class LcfirstTest extends TestCase
{
    // 先頭文字が大文字の場合、先頭のみ小文字に変換されることを確認する
    #[Test]
    public function 先頭大文字が小文字になる(): void
    {
        $actual = new Stringer('ABC');

        $this->assertEquals(new Stringer('aBC'), $actual->lcfirst());
    }

    // すでに先頭が小文字の場合に、変化がないことを確認する
    #[Test]
    public function 先頭小文字は変更されない(): void
    {
        $actual = new Stringer('abc');

        $this->assertEquals(new Stringer('abc'), $actual->lcfirst());
    }
}