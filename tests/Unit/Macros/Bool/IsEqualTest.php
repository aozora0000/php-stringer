<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsEqual;
use Stringer\Stringable;
use Tests\Stringer\Unit\TestCase;

class IsEqualTest extends TestCase
{
    #[Test]
    public function 同じ文字列か比較する(): void
    {
        $instance = new IsEqual();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => 'test');
        $this->assertTrue($instance($stringable, 'test'));
    }

    #[Test]
    public function 違う文字列の場合はFalseが返る(): void
    {
        $instance = new IsEqual();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => 'test');
        $this->assertFalse($instance($stringable, 'aaa'));
    }

    #[Test]
    public function 空の場合は空文字か比較する(): void
    {
        $instance = new IsEqual();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => '');
        $this->assertTrue($instance($stringable));
    }
}