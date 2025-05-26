<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Stringable;
use Stringer\Stringer;
use Stringer\Macros\Stringer\Substr;

class SubstrTest extends TestCase
{
    /**
     * 引数なしで呼び出した場合、文字列全体を返すことを確認
     */
    #[Test]
    public function 引数なしの場合は文字列全体を返す(): void
    {
        // テスト対象のインスタンスを作成
        $substr = new Substr();
        
        // モックを作成
        $stringableMock = $this->createMock(Stringable::class);
        $stringableMock->method('__toString')
            ->willReturn('テスト文字列');
            
        $actual = $substr($stringableMock);
        
        $this->assertEquals('テスト文字列', (string)$actual);
    }

    /**
     * 開始位置のみ指定した場合、その位置から最後までの部分文字列を返すことを確認
     */
    #[Test]
    public function 開始位置のみ指定した場合は指定位置から最後までを返す(): void
    {
        $substr = new Substr();
        
        $stringableMock = $this->createMock(Stringable::class);
        $stringableMock->method('__toString')
            ->willReturn('テスト文字列');
            
        $actual = $substr($stringableMock, 2);
        
        $this->assertEquals('ト文字列', (string)$actual);
    }

    /**
     * 開始位置と長さを指定した場合、指定された範囲の部分文字列を返すことを確認
     */
    #[Test]
    public function 開始位置と長さを指定した場合は指定範囲の文字列を返す(): void
    {
        $substr = new Substr();
        
        $stringableMock = $this->createMock(Stringable::class);
        $stringableMock->method('__toString')
            ->willReturn('テスト文字列');
            
        $actual = $substr($stringableMock, '1', '2');
        
        $this->assertEquals('スト', (string)$actual);
    }

    /**
     * 負の開始位置を指定した場合、末尾からの位置で部分文字列を返すことを確認
     */
    #[Test]
    public function 負の開始位置の場合は末尾からの位置で文字列を返す(): void
    {
        $substr = new Substr();
        
        $stringableMock = $this->createMock(Stringable::class);
        $stringableMock->method('__toString')
            ->willReturn('テスト文字列');
            
        $actual = $substr($stringableMock, '-3');
        
        $this->assertEquals('文字列', (string)$actual);
    }
}