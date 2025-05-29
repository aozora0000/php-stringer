<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Studly;
use Stringer\Stringable;
use Stringer\Stringer;

class StudlyTest extends TestCase
{
    /**
     * スタッドリーケースで単語を大文字に変換できるか確認する
     */
    #[Test]
    public function 英単語区切りがハイフンの場合スタッドリーケースに変換できる(): void
    {
        $actual = new Stringer('hello-world');

        $this->assertInstanceOf(Stringer::class, $actual->studly());
        $this->assertSame('HelloWorld', $actual->studly()->toString());;
    }
}