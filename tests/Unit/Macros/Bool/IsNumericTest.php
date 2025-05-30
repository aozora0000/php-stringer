<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsEqual;
use Stringer\Macros\Bool\IsNumeric;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class IsNumericTest extends TestCase
{
    #[Test]
    public function 整数だとTrueが返る(): void
    {
        $instance = new IsNumeric();
        $stringable = new Stringer('123');
        $this->assertTrue($instance($stringable));
    }

    #[Test]
    public function 負の整数だとTrueが返る(): void
    {
        $instance = new IsNumeric();
        $stringable = new Stringer('-123');
        $this->assertTrue($instance($stringable));
    }

    #[Test]
    public function 実数だとTrueが返る(): void
    {
        $instance = new IsNumeric();
        $stringable = new Stringer('123.456');
        $this->assertTrue($instance($stringable));
    }

    #[Test]
    public function 文字列だとFalseが返る(): void
    {
        $instance = new IsNumeric();
        $stringable = new Stringer('test');
        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function 指数表記だとTrueが返る(): void
    {
        $instance = new IsNumeric();
        $stringable = new Stringer('1e5');
        $this->assertTrue($instance($stringable));
    }

    #[Test]
    public function 負の指数表記だとTrueが返る(): void
    {
        $instance = new IsNumeric();
        $stringable = new Stringer('-1e5');
        $this->assertTrue($instance($stringable));
    }
}