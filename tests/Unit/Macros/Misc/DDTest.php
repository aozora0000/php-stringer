<?php

namespace Tests\Stringer\Unit\Macros\Misc;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class DDTest extends TestCase
{
    #[Test]
    public function テスト(): void
    {
        $this->assertContains('dd', array_keys(Stringer::all()));
    }
}