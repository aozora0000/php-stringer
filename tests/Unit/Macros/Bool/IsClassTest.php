<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\IsClass;
use Stringer\Stringer;

class IsClassTest extends TestCase
{
    #[Test]
    public function 存在するクラス名を渡すとtrueを返す(): void
    {
        $instance = new IsClass();
        $stringable = new Stringer('stdClass');

        $actual = $instance($stringable);

        $this->assertTrue($actual);
    }

    #[Test]
    public function 存在しないクラス名を渡すとfalseを返す(): void
    {
        $instance = new IsClass();
        $stringable = new Stringer('NonExistentClass');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function 空文字列を渡すとfalseを返す(): void
    {
        $instance = new IsClass();
        $stringable = new Stringer('');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function 名前空間付きクラス名を渡すとtrueを返す(): void
    {
        $instance = new IsClass();
        $stringable = new Stringer(Carbon::class);

        $actual = $instance($stringable);

        $this->assertTrue($actual);
    }

    #[Test]
    public function 引数が渡されても正常に動作する(): void
    {
        $instance = new IsClass();
        $stringable = new Stringer('stdClass');

        $actual = $instance($stringable, 'extra', 'arguments');

        $this->assertTrue($actual);
    }
}