<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Stringer\Offset;
use Stringer\Macros\Stringer\Replace;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class ReplaceTest extends TestCase
{
    #[Test]
    public function 一部文字列をデフォルト動作で空に入れ替える(): void
    {
        $instance = new Replace();
        $stringable = new Stringer('test');
        $this->assertSame('es', $instance($stringable, 't')->toString());
    }

    #[Test]
    public function 一部文字列を入れ替える(): void
    {
        $instance = new Replace();
        $stringable = new Stringer('test');
        $this->assertSame('aesa', $instance($stringable, 't', 'a')->toString());
    }

    #[Test]
    public function 配列が指定の一部文字列を入れ替える(): void
    {
        $instance = new Replace();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(function (string $name, array $arguments): Stringable|string|int|float|bool|array {
                return match($name) {
                    'toString' => '-_test',
                };
            });
        $this->assertSame('aatest', $instance($stringable, ['-', '_'], 'a')->toString());
    }
}