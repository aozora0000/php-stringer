<?php

namespace Tests\Stringer\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Wrap;
use Stringer\Stringable;

class WrapTest extends TestCase
{
    #[Test]
    public function プレフィックスとサフィックスが指定された場合は文字列の前後に追加される(): void
    {
        $instance = new Wrap();
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')
            ->willReturnCallback(fn() => 'test');

        $actual =  $instance($stringable, '<<', '>>')->toString();
        $this->assertEquals('<<test>>', $actual);;
    }

    #[Test]
    public function プレフィックスのみが指定された場合は文字列の前に追加される(): void
    {
        $instance = new Wrap();
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')
            ->willReturnCallback(fn() => 'test');

        $actual = $instance($stringable, '<<')->toString();
        $this->assertEquals('<<test<<', $actual);
    }

    #[Test]
    public function 引数が指定されない場合は元の文字列がそのまま返される(): void
    {
        $instance = new Wrap();
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__call')
            ->willReturnCallback(fn() => 'test');


        $actual = $instance($stringable)->toString();

        $this->assertEquals('test', $actual);
    }
}