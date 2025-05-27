<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class MaskTest extends TestCase
{
    #[Test]
    public function 先頭から任意の文字数を残してマスクする(): void
    {
        $instance = new Stringer('taylor@example.com');
        $actual = $instance->mask('*', 3);
        $this->assertSame('tay***************', $actual->toString());
    }

    #[Test]
    public function インデックスに負数を指定して任意の長さのみマスクする(): void
    {
        $instance = new Stringer('taylor@example.com');
        $actual = $instance->mask('*', -15, 3);
        $this->assertSame('tay***@example.com', $actual->toString());
    }
}