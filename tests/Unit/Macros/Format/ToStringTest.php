<?php

namespace Tests\Stringer\Unit\Macros\Format;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Stringable;
use Stringer\Macros\Format\ToString;

class ToStringTest extends TestCase
{
    /**
     * Stringableオブジェクトが文字列に変換されることを確認
     */
    #[Test]
    public function 文字列への変換が成功する(): void
    {
        $instance = new ToString();
        $stringable = $this->createMock(Stringable::class);
        $stringable->method('__toString')
            ->willReturnCallback(fn (): string => 'テスト文字列');

        $this->assertSame('テスト文字列', $instance($stringable));
    }
}