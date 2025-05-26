<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use Stringer\Stringable;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsBoolean;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class IsBooleanTest extends TestCase
{
    #[Test]
    public function Trueの場合はTrueが返る(): void
    {
        $instance = new IsBoolean();
        $stringable = $this->createMock(Stringer::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => 'true');
        $this->assertTrue($instance($stringable));
    }

    #[Test]
    public function （1）の場合はTrueが返る(): void
    {
        $instance = new IsBoolean();
        $stringable = $this->createMock(Stringer::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => '1');
        $this->assertTrue($instance($stringable));
    }

    #[Test]
    public function Falseの場合はTrueが返る(): void
    {
        $instance = new IsBoolean();
        $stringable = $this->createMock(Stringer::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => 'false');
        $this->assertTrue($instance($stringable));
    }

    #[Test]
    public function （0）の場合はTrueが返る(): void
    {
        $instance = new IsBoolean();
        $stringable = $this->createMock(Stringer::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => '0');
        $this->assertTrue($instance($stringable));
    }
}