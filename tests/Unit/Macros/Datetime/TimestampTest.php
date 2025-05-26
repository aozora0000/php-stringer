<?php

namespace Tests\Stringer\Unit\Macros\Datetime;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Datetime\Datetime;
use Stringer\Macros\Datetime\Timestamp;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class TimestampTest extends TestCase
{
    #[Test]
    public function パース可能な日付文字列の場合タイムスタンプを返却する(): void
    {
        $instance = new Timestamp();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments) => '2021-01-01 12:00:00');
        $this->assertSame('1609502400', $instance($stringable)->toString());
    }

    #[Test]
    public function 日時文字列でない場合は例外を投げる(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $instance = new Timestamp();
        $stringable = $this->createMock(Stringable::class);
        $stringable
            ->method('__call')
            ->willReturnCallback(fn(string $name, array $arguments) => 'abcde');
        $instance($stringable);
    }
}