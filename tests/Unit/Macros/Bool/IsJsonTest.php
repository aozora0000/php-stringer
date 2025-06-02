<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\IsJson;
use Stringer\Stringable;
use Stringer\Stringer;

/**
 * IsJsonクラスの単体テスト
 */
class IsJsonTest extends TestCase
{
    /**
     * 正常なJSON文字列の場合、trueが返ること
     */
    #[Test]
    public function 正常なjson文字列の場合_trueが返ること(): void
    {
        $stringable = new Stringer('{"a":1}');

        $instance = new IsJson();
        $this->assertTrue($instance($stringable));
    }

    /**
     * 不正なJSON文字列の場合、falseが返ること
     */
    #[Test]
    public function 不正なjson文字列の場合_falseが返ること(): void
    {
        $stringable = new Stringer('{"a":1');

        $instance = new IsJson();
        $this->assertFalse($instance($stringable));
    }
}