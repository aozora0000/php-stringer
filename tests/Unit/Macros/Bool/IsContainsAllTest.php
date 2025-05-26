<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsContainsAll;
use Stringer\Stringable;
use Tests\Stringer\Unit\TestCase;

class IsContainsAllTest extends TestCase
{
    #[Test]
    public function 空の文字列の場合はFalseを返す(): void
    {
        $instance = new IsContainsAll();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => '');
        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function 特定の文字列が一致する場合はTrueを返す(): void
    {
        $instance = new IsContainsAll();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => 'test');
        $this->assertTrue($instance($stringable, 'st'));
    }

    #[Test]
    public function １つでも特定の文字列が一致する場合はTrueを返す(): void
    {
        $instance = new IsContainsAll();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => 'test');
        $this->assertTrue($instance($stringable, 'te', 'es', 'st'));
    }

    #[Test]
    public function １つでも特定の文字列が一致しない場合はFalseを返す(): void
    {
        $instance = new IsContainsAll();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => 'test');
        $this->assertFalse($instance($stringable, 'te', 'es', 'cc'));
    }
}