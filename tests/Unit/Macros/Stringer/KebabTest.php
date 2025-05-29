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
            'hello-world',
            'helloWorld',
        ];

        yield [
            'foo-bar',
            'foo_bar',
        ];

        yield [
            'foo-bar-baz',
            'foo bar baz',
        ];

        yield [
            'foo-bar-baz',
            'Foo Bar Baz',
        ];

        yield [
            'foo-bar',
            'FooBar',
        ];

        yield [
            'hello-world',
            'hello_world',
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