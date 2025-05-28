<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Stringer\Singular;
use Stringer\Stringable;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;

class SingularTest extends TestCase
{
    /** 不規則名詞'children'が'child'に変換されることを検証する */
    #[Test]
    public function 不規則名詞が変換されること()
    {
        $instance = new Stringer('children');
        $this->assertSame('child', $instance->singular()->toString());
    }

    /** 語尾がs, sh, ch, x, zの場合、'es'が付くことを検証する */
    #[Test]
    public function 語尾が_esの場合に_s_sh_ch_x_zが付加されること()
    {
        $instance = new Stringer('brushes');
        $this->assertSame('brush', $instance->singular()->toString());
    }

    /** 語尾が子音字iesで終わる場合、'y'が付くことを検証する */
    #[Test]
    public function 子音字_yで終わる場合_iesが付加されること()
    {
        $instance = new Stringer('parties');
        $this->assertSame('party', $instance->singular()->toString());
    }

    /** 語尾がvesで終わる場合、'f'が付くことを検証する */
    #[Test]
    public function 語尾がfで終わる場合_vesが付加されること()
    {
        $instance = new Stringer('wolves');
        $this->assertSame('wolf', $instance->singular()->toString());
    }

    /** 語尾がesで終わる場合、'o'が付くことを検証する */
    #[Test]
    public function 語尾がoで終わる場合_esが付加されること()
    {
        $instance = new Stringer('heroes');
        $this->assertSame('hero', $instance->singular()->toString());
    }

    /** その他の場合、's'が消えることを検証する */
    #[Test]
    public function その他の場合_sが付加されること()
    {
        $instance = new Stringer('cats');
        $this->assertSame('cat', $instance->singular()->toString());
    }
}