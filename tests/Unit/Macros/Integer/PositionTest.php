<?php

namespace Tests\Stringer\Unit\Macros\Integer;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Integer\Position;
use Stringer\Stringable;
use Stringer\Stringer;

class PositionTest extends TestCase
{
    /**
     * 文字列内の指定された文字の位置を正しく返すことを確認
     */
    #[Test]
    public function 基本的な文字位置検索の確認(): void
    {
        // テスト対象のインスタンスを作成
        $position = new Position();
        
        // Stringableインターフェースのモックを作成
        $stringable = new Stringer('テスト文字列');

        $actual = $position($stringable, '文字');
        $this->assertSame(3, $actual);
    }

    /**
     * オフセットを指定した場合の検索位置を確認
     */
    #[Test]
    public function オフセット指定での文字位置検索の確認(): void
    {
        $position = new Position();
        
        $stringable = new Stringer('あいうえおあいうえお');

        $actual = $position($stringable, 'あ', 3);
        $this->assertSame(5, $actual);
    }

    /**
     * 検索文字列が見つからない場合はfalseが返されることを確認
     */
    #[Test]
    public function 存在しない文字列の検索結果確認(): void
    {
        $position = new Position();
        
        $stringable = new Stringer('テスト文字列');

        $actual = $position($stringable, 'xyz');
        $this->assertFalse($actual);
    }

    /**
     * 空の検索文字列が渡された場合の動作を確認
     */
    #[Test]
    public function 空文字列での検索確認(): void
    {
        $position = new Position();
        
        $stringable = new Stringer('テスト');

        $actual = $position($stringable);
        $this->assertSame(0, $actual);
    }
}