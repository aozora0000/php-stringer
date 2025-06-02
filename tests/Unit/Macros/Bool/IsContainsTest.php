<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsContains;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class IsContainsTest extends TestCase
{
    #[Test]
    public function 空の文字列の場合はFalseを返す(): void
    {
        $instance = new IsContains();
        $stringable = new Stringer('');
        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function 特定の文字列が一致する場合はTrueを返す(): void
    {
        $instance = new IsContains();
        $stringable = new Stringer('test');
        $this->assertTrue($instance($stringable, 'st'));
    }

    #[Test]
    public function １つでも特定の文字列が一致する場合はTrueを返す(): void
    {
        $instance = new IsContains();
        $stringable = new Stringer('test');
        $this->assertTrue($instance($stringable, 'aa', 'bb', 'st'));
    }

    #[Test]
    public function １つも特定の文字列が一致しない場合はFalseを返す(): void
    {
        $instance = new IsContains();
        $stringable = new Stringer('test');
        $this->assertFalse($instance($stringable, 'aa', 'bb', 'cc'));
    }
}