<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\PluralStudly;
use Stringer\Stringer;

class PluralStudlyTest extends TestCase
{
    /**
     * 単一の単語を複数形に変換できることを確認する
     */
    #[Test]
    public function 単一単語を複数形に変換できる(): void
    {
        // 準備
        $string = new Stringer('Book');
        $pluralStudly = new PluralStudly();
        
        // 実行
        $result = $pluralStudly($string);
        
        // 検証
        $this->assertSame('Books', $result->toString());
    }
    
    /**
     * 複数の単語からなる文字列の最後の単語を複数形に変換できることを確認する
     */
    #[Test]
    public function 複合単語の最後の単語を複数形に変換できる(): void
    {
        // 準備
        $string = new Stringer('BookStore');
        $pluralStudly = new PluralStudly();
        
        // 実行
        $result = $pluralStudly($string);
        
        // 検証
        $this->assertSame('BookStores', $result->toString());
    }
    
    /**
     * 複数の単語からなる長い文字列の最後の単語を複数形に変換できることを確認する
     */
    #[Test]
    public function 長い複合単語の最後の単語を複数形に変換できる(): void
    {
        // 準備
        $string = new Stringer('OnlineBookStoreManager');
        $pluralStudly = new PluralStudly();
        
        // 実行
        $result = $pluralStudly($string);
        
        // 検証
        $this->assertSame('OnlineBookStoreManagers', $result->toString());
    }
    
    /**
     * すでに複数形の単語を処理できることを確認する
     */
    #[Test]
    public function すでに複数形の単語を処理できる(): void
    {
        // 準備
        $string = new Stringer('Books');
        $pluralStudly = new PluralStudly();

        // 実行
        $result = $pluralStudly($string);

        // 検証
        $this->assertSame('Books', $result->toString()); // 複数形のルールに依存
    }
    
    /**
     * 空の文字列を処理できることを確認する
     */
    #[Test]
    public function 空文字列を処理できる(): void
    {
        // 準備
        $string = new Stringer('');
        $pluralStudly = new PluralStudly();
        
        // 実行
        $result = $pluralStudly($string);
        
        // 検証
        $this->assertSame('', $result->toString());
    }
}