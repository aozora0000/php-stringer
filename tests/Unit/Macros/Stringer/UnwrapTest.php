<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Unwrap;
use Stringer\Stringer;

class UnwrapTest extends TestCase
{
    #[Test]
    public function 引数なしの場合は空文字列のプレフィックスとポストフィックスで処理される(): void
    {
        // 引数なしでUnwrapを実行
        $instance = new Unwrap();
        $stringable = new Stringer('test');
        $actual = $instance($stringable);
        $expected = new Stringer('test');

        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function プレフィックスのみ指定した場合はプレフィックスとポストフィックス両方に適用される(): void
    {
        // プレフィックスのみ指定してUnwrapを実行
        $instance = new Unwrap();
        $stringable = new Stringer('"hello world"');
        $actual = $instance($stringable, '"');
        $expected = new Stringer('hello world');

        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function プレフィックスとポストフィックス両方指定した場合はそれぞれが除去される(): void
    {
        // プレフィックスとポストフィックス両方指定してUnwrapを実行
        $instance = new Unwrap();
        $stringable = new Stringer('[hello world}');
        $actual = $instance($stringable, '[', '}');
        $expected = new Stringer('hello world');

        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function 文字列中に同じプレフィックスが複数ある場合は全て除去される(): void
    {
        // 複数のプレフィックスが含まれる文字列でUnwrapを実行
        $instance = new Unwrap();
        $stringable = new Stringer('***hello***world***');
        $actual = $instance($stringable, '***');
        $expected = new Stringer('hello***world');

        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function 除去対象の文字列が存在しない場合は元の文字列がそのまま返される(): void
    {
        // 除去対象が存在しない文字列でUnwrapを実行
        $instance = new Unwrap();
        $stringable = new Stringer('hello world');
        $actual = $instance($stringable, '"');
        $expected = new Stringer('hello world');

        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function 空文字列を処理した場合は空文字列が返される(): void
    {
        // 空文字列でUnwrapを実行
        $instance = new Unwrap();
        $stringable = new Stringer('');
        $actual = $instance($stringable, '"');
        $expected = new Stringer('');

        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function プレフィックスが空文字列の場合は元の文字列がそのまま返される(): void
    {
        // 空文字列のプレフィックスでUnwrapを実行
        $instance = new Unwrap();
        $stringable = new Stringer('hello world');
        $actual = $instance($stringable, '');
        $expected = new Stringer('hello world');

        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function 異なるプレフィックスとポストフィックスで部分的に一致する場合は該当部分が除去される(): void
    {
        // 異なるプレフィックスとポストフィックスでUnwrapを実行
        $instance = new Unwrap();
        $stringable = new Stringer('<hello>world<test>');
        $actual = $instance($stringable, '<', '>');
        $expected = new Stringer('hello>world<test');

        $this->assertEquals($expected->toString(), $actual->toString());
    }
}