<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Limit;
use Stringer\Stringable;
use Stringer\Stringer;

/**
 * Limitクラスのユニットテスト
 */
class LimitTest extends TestCase
{
    #[Test]
    /** 文字列が制限以内の時、元のStringableが返ること */
    public function 文字列幅が制限以内の場合に元のインスタンスを返すこと(): void
    {
        $stringValue = '短い文字列';
        $stringable = new Stringer($stringValue);

        $limit = new Limit();
        $actual = $limit($stringable, 20);

        $this->assertSame($stringable, $actual);
    }

    #[Test]
    /** 文字列が制限を超えた時、切り詰めてStringerで返すこと */
    public function 文字列幅が制限を超えた場合に切り詰めて返すこと(): void
    {
        $stringValue = 'これはとても長いテキストサンプルです';
        $stringable = new Stringer($stringValue);

        $limit = new Limit();
        $actual = $limit($stringable, 10);
        $this->assertSame('これはとて...', (string)$actual);
    }

    #[Test]
    /** 文字列が制限を超えた時、末尾にデフォルト("...")が付与されること */
    public function 文字列幅オーバー時にデフォルトの末尾がつくこと(): void
    {
        $stringValue = 'これはとても長いテキストサンプルです';
        $stringable = new Stringer($stringValue);

        $limit = new Limit();
        /** @var Stringer $actual */
        $actual = $limit($stringable, 10);

        $this->assertStringEndsWith('...', (string)$actual);
    }

    #[Test]
    /** 第二引数で末尾を指定した場合に、その文字列が末尾につくこと */
    public function 末尾を指定した時指定文字が末尾につくこと(): void
    {
        $stringValue = 'これはとても長いテキストサンプルです';
        $stringable = new Stringer($stringValue);

        $limit = new Limit();
        /** @var Stringer $actual */
        $actual = $limit($stringable, 10, '（終）');

        $this->assertStringEndsWith('（終）', (string)$actual);
    }
}