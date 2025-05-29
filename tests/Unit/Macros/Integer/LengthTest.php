<?php

namespace Tests\Stringer\Unit\Macros\Integer;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsNumeric;
use Stringer\Macros\Integer\Length;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class LengthTest extends TestCase
{
    #[Test]
    public function オフセットなしで文字数をカウントする(): void
    {
        $instance = new Length();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(function (string $name, array $arguments): Stringable|string|int|float|bool|array {
                return match($name) {
                    'isEmpty' => false,
                    'toString' => 'test',
                };
            });
        $this->assertSame(4, $instance($stringable));
    }

    #[Test]
    public function 空文字の場合は0を返す(): void
    {
        $instance = new Length();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(function (string $name, array $arguments): Stringable|string|int|float|bool|array {
                return match($name) {
                    'isEmpty' => true,
                    'toString' => '',
                };
            });
        $this->assertSame(0, $instance($stringable));
    }

    #[Test]
    public function オフセットありで文字数をカウントする(): void
    {
        $instance = new Length();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(function (string $name, array $arguments): Stringable|string|int|float|bool|array {
                return match($name) {
                    'isEmpty' => false,
                    'toString' => 'test',
                };
            });
        $this->assertSame(2, $instance($stringable, 2));
    }

    #[Test]
    public function 元の文字数よりオフセットが多い場合0を返す(): void
    {
        $instance = new Length();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(function (string $name, array $arguments): Stringable|string|int|float|bool|array {
                return match($name) {
                    'isEmpty' => false,
                    'toString' => 'test',
                };
            });
        $this->assertSame(0, $instance($stringable, 5));
    }
}