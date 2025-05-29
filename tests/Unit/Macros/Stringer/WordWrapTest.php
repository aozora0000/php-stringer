<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\WordWrap;
use Stringer\Stringer;

/**
 * WordWrapクラスのユニットテスト
 */
class WordWrapTest extends TestCase
{
    #[Test]
    public function デフォルト設定で文字列をラップする(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new WordWrap();
        
        // テスト用の長い文字列を作成
        $input = new Stringer('これは非常に長い文字列で、デフォルトの幅75文字でラップされるべきテスト文字列です。');
        
        // 実行
        $actual = $instance($input);
        
        // 期待値
        $expected = new Stringer(wordwrap('これは非常に長い文字列で、デフォルトの幅75文字でラップされるべきテスト文字列です。', 75, "\n", true));
        
        // アサーション
        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function 指定した幅で文字列をラップする(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new WordWrap();
        
        // テスト用の文字列を作成
        $input = new Stringer('This is a test string that should be wrapped at 20 characters.');
        
        // 実行（幅20を指定）
        $actual = $instance($input, '20');
        
        // 期待値
        $expected = new Stringer(wordwrap('This is a test string that should be wrapped at 20 characters.', 20, "\n", true));
        
        // アサーション
        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function 指定した改行文字で文字列をラップする(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new WordWrap();
        
        // テスト用の文字列を作成
        $input = new Stringer('This is a test string that should be wrapped with custom break.');
        
        // 実行（幅30、改行文字に<br>を指定）
        $actual = $instance($input, '30', '<br>');
        
        // 期待値
        $expected = new Stringer(wordwrap('This is a test string that should be wrapped with custom break.', 30, '<br>', true));
        
        // アサーション
        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function カット設定をfalseにして文字列をラップする(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new WordWrap();
        
        // テスト用の文字列を作成（長い単語を含む）
        $input = new Stringer('This verylongwordthatexceedswidth should not be cut.');
        
        // 実行（幅20、デフォルト改行文字、カット無効）
        $actual = $instance($input, 20, "\n", false);
        
        // 期待値
        $expected = new Stringer(wordwrap('This verylongwordthatexceedswidth should not be cut.', 20, "\n", false));
        
        // アサーション
        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function 空文字列を処理する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new WordWrap();
        
        // 空文字列を作成
        $input = new Stringer('');
        
        // 実行
        $actual = $instance($input);
        
        // 期待値
        $expected = new Stringer('');
        
        // アサーション
        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function 短い文字列をそのまま返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new WordWrap();
        
        // 短い文字列を作成
        $input = new Stringer('短い文字列');
        
        // 実行
        $actual = $instance($input);
        
        // 期待値
        $expected = new Stringer('短い文字列');
        
        // アサーション
        $this->assertEquals($expected->toString(), $actual->toString());
    }

    #[Test]
    public function すべてのパラメータを指定して文字列をラップする(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new WordWrap();
        
        // テスト用の文字列を作成
        $input = new Stringer('This is a comprehensive test with all parameters specified for wrapping.');
        
        // 実行（すべてのパラメータを指定）
        $actual = $instance($input, '25', ' | ', 'true');
        
        // 期待値
        $expected = new Stringer(wordwrap('This is a comprehensive test with all parameters specified for wrapping.', 25, ' | ', true));
        
        // アサーション
        $this->assertEquals($expected->toString(), $actual->toString());
    }
}