<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsEmpty;
use Stringer\Stringable;
use Tests\Stringer\Unit\TestCase;

class IsEmptyTest extends TestCase
{
    #[Test]
    public function 空文字ではTrueが返る(): void
    {
        $instance = new IsEmpty();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => '');
        $this->assertTrue($instance($stringable));
    }

    #[Test]
    public function 空文字でないとFalseが返る(): void
    {
        $instance = new IsEmpty();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => 'test');
        $this->assertFalse($instance($stringable));
    }
}