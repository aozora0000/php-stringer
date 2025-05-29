<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Plural;
use Stringer\Stringable;
use Stringer\Stringer;

class PluralTest extends TestCase
{
    /** 不規則名詞'child'が'children'に変換されることを検証する */
    #[Test]
    public function 不規則名詞が変換されること(): void
    {
        $instance = new Stringer('child');
        $this->assertSame('children', $instance->plural()->toString());
    }

    /** 語尾がs, sh, ch, x, zの場合、'es'が付くことを検証する */
    #[Test]
    public function 語尾が_s_sh_ch_x_zの場合に_esが付加されること(): void
    {
        $instance = new Stringer('brush');
        $this->assertSame('brushes', $instance->plural()->toString());
    }

    /** 語尾が子音字+yで終わる場合、'ies'が付くことを検証する */
    #[Test]
    public function 子音字_yで終わる場合_iesが付加されること(): void
    {
        $instance = new Stringer('party');
        $this->assertSame('parties', $instance->plural()->toString());
    }

    /** 語尾がfで終わる場合、'ves'が付くことを検証する */
    #[Test]
    public function 語尾がfで終わる場合_vesが付加されること(): void
    {
        $instance = new Stringer('wolf');
        $this->assertSame('wolves', $instance->plural()->toString());
    }

    /** 語尾がfeで終わる場合、'ves'が付くことを検証する */
    #[Test]
    public function 語尾がfeで終わる場合_vesが付加されること(): void
    {
        $instance = new Stringer('knife');
        $this->assertSame('knives', $instance->plural()->toString());
    }

    /** 語尾がoで終わる場合、'es'が付くことを検証する */
    #[Test]
    public function 語尾がoで終わる場合_esが付加されること(): void
    {
        $instance = new Stringer('hero');
        $this->assertSame('heroes', $instance->plural()->toString());
    }

    /** その他の場合、's'が付くことを検証する */
    #[Test]
    public function その他の場合_sが付加されること(): void
    {
        $instance = new Stringer('cat');
        $this->assertSame('cats', $instance->plural()->toString());
    }
}