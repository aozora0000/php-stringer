<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Macros\Stringer\Hash;
use Stringer\Stringer;
use Tests\Stringer\Unit\TestCase;


class HashTest extends TestCase
{
    #[Test]
    public function デフォルトでsha1ハッシュが実行される(): void
    {
        $stringable = new Stringer('test');
        $instance = new Hash();
        
        $actual = $instance($stringable);
        
        $this->assertSame(hash('sha1', 'test'), (string)$actual);
    }

    #[Test]
    public function 指定されたハッシュアルゴリズムmd5が使用される(): void
    {
        $stringable = new Stringer('test');
        $instance = new Hash();
        
        $actual = $instance($stringable, 'md5');

        $this->assertSame(md5('test'), (string)$actual);
    }

    #[Test]
    public function 指定されたハッシュアルゴリズムsha256が使用される(): void
    {
        $stringable = new Stringer('test');
        $instance = new Hash();
        
        $actual = $instance($stringable, 'sha256');
        $this->assertSame(hash('sha256', 'test'), (string)$actual);
    }

    #[Test]
    public function 存在する関数md5がハッシャーとして使用される(): void
    {
        $stringable = new Stringer('test');
        $instance = new Hash();
        
        $actual = $instance($stringable, 'md5');
        
        $this->assertSame(md5('test'), (string)$actual);
    }

    #[Test]
    public function 存在する関数sha1がハッシャーとして使用される(): void
    {
        $stringable = new Stringer('test');
        $instance = new Hash();
        
        $actual = $instance($stringable, 'sha1');
        
        $this->assertSame(sha1('test'), (string)$actual);
    }

    #[Test]
    public function 呼び出し可能オブジェクトがハッシャーとして使用される(): void
    {
        $stringable = new Stringer('test');
        
        // 呼び出し可能オブジェクトを作成
        $callable = function(string $str): string { 
            return 'custom_hash_' . $str; 
        };

        $instance = new Hash();
        
        $actual = $instance($stringable, $callable);
        
        $this->assertSame('custom_hash_test', (string)$actual);
    }

    #[Test]
    public function 無効なハッシャーで例外が投げられる(): void
    {
        $stringable = new Stringer('test');
        $instance = new Hash();

        // 例外の期待設定
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid hasher');

        // テスト実行（存在しないハッシュアルゴリズム）
        $instance($stringable, 'invalid_hash_algorithm');
    }

    #[Test]
    public function 追加引数がハッシュ関数に渡される(): void
    {
        $stringable = new Stringer('test');
        $instance = new Hash();

        // テスト実行（バイナリ出力フラグを追加）
        $actual = $instance($stringable, 'sha1', true);

        $this->assertEquals(mb_convert_encoding(hash('sha1', 'test', true), 'UTF-8'), (string)$actual);
    }

    #[Test]
    public function 空の引数配列でデフォルトハッシャーが使用される(): void
    {
        $stringable = new Stringer('hello');
        $instance = new Hash();
        
        // テスト実行（引数なし）
        $actual = $instance($stringable);
        
        $this->assertSame(hash('sha1', 'hello'), (string)$actual);
    }

    #[Test]
    public function 複数の追加引数がハッシュ関数に渡される(): void
    {
        $stringable = new Stringer('test');

        // 複数の引数を受け取るカスタム関数
        $callable = function($str, string $prefix, string $suffix): string { 
            return $prefix . hash('md5', $str) . $suffix; 
        };

        $instance = new Hash();
        
        $actual = $instance($stringable, $callable, 'prefix_', '_suffix');
        
        $this->assertSame('prefix_' . hash('md5', 'test') . '_suffix', (string)$actual);
    }

    #[Test]
    public function 異なる文字列でsha1ハッシュが正しく実行される(): void
    {
        $stringable = new Stringer('different_string');
        $instance = new Hash();
        
        $actual = $instance($stringable);
        
        $this->assertSame(hash('sha1', 'different_string'), (string)$actual);
    }

    #[Test]
    public function 空文字列でハッシュが正しく実行される(): void
    {
        $stringable = new Stringer('');
        $instance = new Hash();
        
        $actual = $instance($stringable, 'md5');
        
        $this->assertSame(hash('md5', ''), (string)$actual);
    }

    #[Test]
    public function 日本語文字列でハッシュが正しく実行される(): void
    {
        $stringable = new Stringer('こんにちは');
        $instance = new Hash();
        
        $actual = $instance($stringable, 'sha256');
        
        $this->assertSame(hash('sha256', 'こんにちは'), (string)$actual);
    }
}