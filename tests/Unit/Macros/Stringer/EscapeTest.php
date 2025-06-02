<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Macros\Stringer\Escape;
use Stringer\Stringer;

class EscapeTest extends TestCase
{
    #[Test]
    #[DataProvider('htmlエスケープ成功データプロバイダー')]
    public function htmlエスケープが正常に実行される(string $input, array $arguments, string $expected): void
    {
        $stringer = new Stringer($input);
        $instance = new Escape();

        $actual = ($instance)($stringer, 'html', ...$arguments);

        $this->assertEquals($expected, $actual->toString());
    }

    public static function htmlエスケープ成功データプロバイダー(): \Iterator
    {
        yield 'HTMLタグあり' => ['<script>alert("test")</script>', [], '&lt;script&gt;alert(&quot;test&quot;)&lt;/script&gt;'];
        yield 'HTMLエンティティ' => ['<p>Hello & Goodbye</p>', [], '&lt;p&gt;Hello &amp; Goodbye&lt;/p&gt;'];
        yield '引用符あり' => ['He said "Hello"', [], 'He said &quot;Hello&quot;'];
        yield '追加引数あり' => ['<div>content</div>', [ENT_QUOTES, 'UTF-8'], '&lt;div&gt;content&lt;/div&gt;'];
        yield '空文字列' => ['', [], ''];
    }

    #[Test]
    #[DataProvider('urlエスケープ成功データプロバイダー')]
    public function urlエスケープが正常に実行される(string $input, array $arguments, string $expected): void
    {
        $stringer = new Stringer($input);
        $instance = new Escape();

        $actual = ($instance)($stringer, 'url', ...$arguments);

        $this->assertEquals($expected, $actual->toString());
    }

    public static function urlエスケープ成功データプロバイダー(): \Iterator
    {
        yield 'スペースあり' => ['http://example.com/hello world', [], 'http://example.com/helloworld'];
        yield '特殊文字あり' => ['https://example.com/param=value&other=test', [], 'https://example.com/param=value&other=test'];
        yield '日本語あり' => ['http://example.com/こんにちは世界', [], 'http://example.com/こんにちは世界'];
        yield '追加引数あり' => ['ftp://example.com/test string', [['ftp']], 'ftp://example.com/teststring'];
        yield '空文字列' => ['http://', [], 'http://'];
    }

    #[Test]
    #[DataProvider('sqlエスケープ成功データプロバイダー')]
    public function sqlエスケープが正常に実行される(string $input, string $expected): void
    {
        $stringer = new Stringer($input);
        $instance = new Escape();

        $actual = ($instance)($stringer, 'sql');
        $this->assertEquals($expected, $actual->toString());
    }

    public static function sqlエスケープ成功データプロバイダー(): \Iterator
    {
        yield 'SQLインジェクション攻撃' => ["test'; DROP TABLE users; --", "test\'; DROP TABLE users; "];
        yield '単一引用符' => ["O'Brien", "O\'Brien"];
        yield '複数の引用符' => ["'test' AND '1'='1'", "\'test\' AND \'1\'=\'1\'"];
        yield '通常の文字列' => ['normal text', 'normal text'];
        yield '空文字列' => ['', ''];
    }

    #[Test]
    #[DataProvider('無効なエスケープタイプデータプロバイダー')]
    public function 無効なエスケープタイプで例外が発生する(string $input, string $invalidType): void
    {
        $stringer = new Stringer($input);
        $instance = new Escape();

        $this->expectException(InvalidArgumentException::class);

        ($instance)($stringer, $invalidType);
    }

    public static function 無効なエスケープタイプデータプロバイダー(): \Iterator
    {
        yield 'xml' => ['test', 'xml'];
        yield 'json' => ['test', 'json'];
        yield 'csv' => ['test', 'csv'];
        yield '存在しないタイプ' => ['test', 'nonexistent'];
    }

    #[Test]
    #[DataProvider('非文字列エスケープタイプデータプロバイダー')]
    public function 非文字列エスケープタイプで例外が発生する(string $input, mixed $invalidType): void
    {
        $stringer = new Stringer($input);
        $instance = new Escape();

        $this->expectException(InvalidArgumentException::class);

        ($instance)($stringer, $invalidType);
    }

    public static function 非文字列エスケープタイプデータプロバイダー(): \Iterator
    {
        yield '数値' => ['test', 123];
        yield '配列' => ['test', ['html']];
        yield 'boolean' => ['test', true];
        yield 'オブジェクト' => ['test', new \stdClass()];
    }

    #[Test]
    public function デフォルトでhtmlエスケープが実行される(): void
    {
        $stringer = new Stringer('<script>test</script>');
        $instance = new Escape();

        $actual = ($instance)($stringer);

        $this->assertEquals('&lt;script&gt;test&lt;/script&gt;', $actual->toString());
    }

    #[Test]
    public function 無効なエスケープタイプの例外メッセージが正しい(): void
    {
        $stringer = new Stringer('test');
        $instance = new Escape();

        $this->expectExceptionMessage("Invalid escape type: invalid. Must be one of: html, url, sql");

        ($instance)($stringer, 'invalid');
    }

    #[Test]
    public function エスケープタイプの型エラー例外メッセージが正しい(): void
    {
        $stringer = new Stringer('test');
        $instance = new Escape();

        $this->expectExceptionMessage("Escape type must be a string");

        ($instance)($stringer, 123);
    }
}