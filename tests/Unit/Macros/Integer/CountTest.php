<?php

namespace Tests\Stringer\Unit\Macros\Integer;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Format\ToBinary;
use Stringer\Macros\Integer\Count;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class CountTest extends TestCase
{
    #[Test]
    public function 文字列から特定文字列が何回出現するか(): void
    {
        $instance = new Count();
        $stringable = new Stringer('abcdee');
        $this->assertSame(1, $instance($stringable, 'a'));
        $this->assertSame(2, $instance($stringable, 'e'));
        $this->assertSame(1, $instance($stringable, 'ee'));
    }

    #[Test]
    public function 文字列が空の場合は0を返却する(): void
    {
        $instance = new Count();
        $stringable = new Stringer('');
        $this->assertSame(0, $instance($stringable, 'a'));
    }

    #[Test]
    public function 引数が空の場合は0を返却する(): void
    {
        $instance = new Count();
        $stringable = new Stringer('abcdee');
        $this->assertSame(0, $instance($stringable));
    }
}