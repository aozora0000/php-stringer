<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Kebab;
use Stringer\Stringable;
use Stringer\Stringer;

class KebabTest extends TestCase
{
    public static function dataProvider(): \Iterator
    {
        yield [
            'expected' => 'hello-world',
            'actual' => 'helloWorld',
        ];

        yield [
            'expected' => 'foo-bar',
            'actual' => 'foo_bar',
        ];

        yield [
            'expected' => 'foo-bar-baz',
            'actual' => 'foo bar baz',
        ];

        yield [
            'expected' => 'foo-bar-baz',
            'actual' => 'Foo Bar Baz',
        ];

        yield [
            'expected' => 'foo-bar',
            'actual' => 'FooBar',
        ];

        yield [
            'expected' => 'hello-world',
            'actual' => 'hello_world',
        ];
    }

    #[Test]
    #[DataProvider('dataProvider')]
    public function invokeの戻り値がStringerインスタンスである(string $expected, string $actual): void
    {
        $kebab = new Kebab();
        $this->assertSame($expected, (string)$kebab(new Stringer($actual)));
    }
}