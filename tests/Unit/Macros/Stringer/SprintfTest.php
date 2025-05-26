<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Stringer\Replace;
use Stringer\Macros\Stringer\Sprintf;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class SprintfTest extends TestCase
{
    #[Test]
    public function Sprintfマクロを通してフォーマット出来る(): void
    {
        $instance = new Sprintf();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(function (string $name, array $arguments) {
                return match($name) {
                    'toString' => 'World',
                };
            });
        $this->assertSame('Hello World', $instance($stringable, 'Hello %s')->toString());
    }

    #[Test]
    public function Sprintfマクロを通して複数置換でフォーマット出来る(): void
    {
        $instance = new Sprintf();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(function (string $name, array $arguments) {
                return match($name) {
                    'toString' => 'World',
                };
            });
        $this->assertSame('Hello World Test', $instance($stringable, 'Hello %s %s', 'Test')->toString());
    }
}