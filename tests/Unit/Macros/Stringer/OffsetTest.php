<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Integer\Length;
use Stringer\Macros\Stringer\Offset;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class OffsetTest extends TestCase
{
    #[Test]
    public function 空文字または文字数以上のオフセットの場合は空が返ってくる(): void
    {
        $instance = new Offset();
        $stringable = new Stringer('');
        $this->assertSame('', $instance($stringable)->toString());
    }

    #[Test]
    public function 指定文字数オフセット指定文字数までの文字列が返却される(): void
    {
        $instance = new Offset();
        $stringable = new Stringer('abcde');
        $this->assertSame('cde', $instance($stringable, 2)->toString());
        $this->assertSame('c', $instance($stringable, 2, 1)->toString());
    }

    #[Test]
    public function 負数のオフセットの場合は後ろから返却される(): void
    {
        $instance = new Offset();
        $stringable = new Stringer('abcde');
        $this->assertSame('e', $instance($stringable, -1)->toString());
        $this->assertSame('bc', $instance($stringable, -4, 2)->toString());
    }
}