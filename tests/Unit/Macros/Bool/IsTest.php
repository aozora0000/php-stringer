<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\Is;
use Stringer\Macros\Bool\IsNumeric;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class IsTest extends TestCase
{
    #[Test]
    public function 同じ値の場合はTrueを返す(): void
    {
        $instance = new Is();
        $stringable = new Stringer('test');
        $this->assertTrue($instance($stringable, 'test'));
    }

    #[Test]
    public function 違う値の場合はFalseを返す(): void
    {
        $instance = new Is();
        $stringable = new Stringer('aaa');
        $this->assertFalse($instance($stringable, 'test'));
    }
}