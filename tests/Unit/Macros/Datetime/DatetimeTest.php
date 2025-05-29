<?php

namespace Tests\Stringer\Unit\Macros\Datetime;

use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\Is;
use Stringer\Macros\Datetime\Datetime;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class DatetimeTest extends TestCase
{
    #[Test]
    public function 日時文字列からパース・フォーマットする(): void
    {
        $instance = new Datetime();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool|array => '2021-01-01 12:00:00');
        $this->assertSame('2021-01-01', $instance($stringable, 'Y-m-d', 'Asia/Tokyo')->toString());
    }

    #[Test]
    public function 日時文字列でない場合は例外を投げる(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $instance = new Datetime();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool|array => 'abcde');

        $instance($stringable, 'Y-m-d');
    }

    #[Test]
    public function UTCタイムゾーンで日時文字列からパース・フォーマットする(): void
    {
        $instance = new Datetime();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool|array => '2021-01-01 12:00:00');
        $this->assertSame('2021-01-01 12:00:00', $instance($stringable, 'Y-m-d H:i:s', 'UTC')->toString());
    }

    #[Test]
    public function 異なるタイムゾーン間で日時文字列をパース・フォーマットする(): void
    {
        $instance = new Datetime();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments): Stringable|string|int|float|bool|array => '2021-01-01 12:00:00');
        $this->assertSame('2021-01-01 04:00:00', $instance($stringable, 'Y-m-d H:i:s', 'America/Los_Angeles')->toString());
    }

}