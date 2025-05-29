<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Stringer\Camel;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class CamelTest extends TestCase
{
    public static function dataProvider(): Iterator
    {
        yield [
            'helloWorld',
            'hello-world'
        ];

        yield [
            'fooBar',
            'foo_bar'
        ];

        yield [
            'fooBarBaz',
            'foo bar baz'
        ];

        yield [
            'fooBarBaz',
            'Foo_Bar_Baz'
        ];

        yield [
            'fooBar',
            'FooBar'
        ];

        yield [
            'helloWorld',
            'hello_world'
        ];
    }

    #[Test]
    #[DataProvider('dataProvider')]
    public function 文字列をキャメルケースに変換できる(string $expected, string $actual): void
    {
        $instance = new Camel();
        $this->assertSame((string)new Stringer($expected), (string)$instance(new Stringer($actual)));
    }

}