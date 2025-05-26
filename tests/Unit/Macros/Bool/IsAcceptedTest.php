<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsAccepted;
use Stringer\Stringable;
use Tests\Stringer\Unit\TestCase;

class IsAcceptedTest extends TestCase
{
    public static function dataProviderTrue(): \Iterator
    {
        yield ['yes'];
        yield ['y'];
        yield ['true'];
        yield ['1'];
        yield ['on'];
        yield ['enabled'];
        yield ['ok'];
        yield ['accept'];
        yield ['accepted'];
        yield ['同意'];
        yield ['同意する'];
    }

    #[Test]
    #[DataProvider('dataProviderTrue')]
    public function 同意フレーズが存在する場合Trueを返す(string $word): void
    {
        $instance = new IsAccepted();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => $word);
        $this->assertTrue($instance($stringable));
    }

    public static function dataProviderFalse(): \Iterator
    {
        yield ['no'];
        yield ['n'];
        yield ['false'];
        yield ['0'];
        yield ['off'];
        yield ['disabled'];
        yield ['ng'];
        yield ['reject'];
        yield ['rejected'];
        yield ['同意しない'];
    }

    #[Test]
    #[DataProvider('dataProviderFalse')]
    public function 同意フレーズが存在しない場合Falseを返す(string $word): void
    {
        $instance = new IsAccepted();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => $word);
        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function 同意フレーズの判定を追加したい場合(): void
    {
        $instance = new IsAccepted();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool => '判定');
        $this->assertTrue($instance($stringable, '判定'));
    }
}