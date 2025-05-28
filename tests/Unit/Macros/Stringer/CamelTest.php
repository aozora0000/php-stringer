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
            'expected' => 'helloWorld',
            'actual' => 'hello-world'
        ];

        yield [
            'expected' => 'fooBar',
            'actual' => 'foo_bar'
        ];

        yield [
            'expected' => 'fooBarBaz',
            'actual' => 'foo bar baz'
        ];

        yield [
            'expected' => 'fooBarBaz',
            'actual' => 'Foo_Bar_Baz'
        ];

        yield [
            'expected' => 'fooBar',
            'actual' => 'FooBar'
        ];

        yield [
            'expected' => 'helloWorld',
            'actual' => 'hello_world'
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