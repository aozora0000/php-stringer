<?php

namespace Tests\Stringer\Unit;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Stringer;

class StringerTest extends TestCase
{
    #[Test]
    public function マクロ機能をテストする(): void
    {
        Stringer::macro('test', function($stringer, ...$arguments): string {
            $this->assertInstanceOf(Stringer::class, $stringer);
            $this->assertEmpty($arguments);
            return 'test';
        });
        $instance = new Stringer('aaa');
        $this->assertSame('aaa', $instance->toString());
        $this->assertSame('test', $instance->test());
        $this->assertTrue($instance->hasMacro('test', 'closure'));
    }
}