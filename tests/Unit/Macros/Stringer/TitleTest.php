<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Title;
use Stringer\Stringer;

class TitleTest extends TestCase
{
    public static function titleCaseDataProvider(): \Iterator
    {
            yield ['hello world', 'Hello World'];
            yield ['HELLO WORLD', 'Hello World'];
            yield ['heLLo WoRLd', 'Hello World'];
            yield ['a nice title uses the correct case', 'A Nice Title Uses The Correct Case'];
            yield ['', ''];
            yield ['a', 'A'];
            yield ['hello 123 world', 'Hello 123 World'];
            yield ['hello-world test_case', 'Hello-World Test_Case'];
            yield ['こんにちは 世界', 'こんにちは 世界'];
    }

    #[Test]
    #[DataProvider('titleCaseDataProvider')]
    public function titleCaseTest(string $input, string $expected)
    {
        // 準備
        $instance = new Title();
        $stringable = new Stringer($input);

        // 実行
        $actual = $instance($stringable);

        // 検証
        $this->assertEquals($expected, $actual->toString());
    }
}