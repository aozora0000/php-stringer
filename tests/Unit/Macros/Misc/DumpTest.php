<?php

namespace Tests\Stringer\Unit\Macros\Misc;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class DumpTest extends TestCase
{
    #[Test]
    public function テスト(): void
    {
        $this->assertContains('dump', array_keys(Stringer::all()));
    }
}