<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Macros\Stringer\Hash;
use Stringer\Stringer;

class HashTest extends TestCase
{
    #[Test]
    public function デフォルトハッシュアルゴリズムはsha1である(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('test');
        
        // sha1ハッシュを実行
        $actual = $instance($stringable);
        $expected = hash('sha1', 'test', false);
        
        // 結果を検証
        $this->assertEquals($expected, $actual->toString());
    }

    #[Test]
    public function bcryptアルゴリズムでパスワードハッシュができる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('password');
        
        // bcryptハッシュを実行
        $actual = $instance($stringable, 'bcrypt');
        
        // bcryptハッシュが生成されることを検証
        $this->assertTrue(password_verify('password', $actual->toString()));
    }

    #[Test]
    public function argon2iアルゴリズムでパスワードハッシュができる(): void
    {
        if(!defined('PASSWORD_ARGON2I')) {
            $this->markTestSkipped('argon2i is not supported');
        }

        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('password');

        // argon2iハッシュを実行
        $actual = $instance($stringable, 'argon2i');

        // argon2iハッシュが生成されることを検証
        $this->assertTrue(password_verify('password', $actual->toString()));
    }

    #[Test]
    public function argon2idアルゴリズムでパスワードハッシュができる(): void
    {
        if(!defined('PASSWORD_ARGON2ID')) {
            $this->markTestSkipped('argon2id is not supported');
        }

        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('password');

        // argon2idハッシュを実行
        $actual = $instance($stringable, 'argon2id');

        // argon2idハッシュが生成されることを検証
        $this->assertTrue(password_verify('password', $actual->toString()));
    }

    #[Test]
    public function md5ハッシュアルゴリズムが使用できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('test');
        
        // md5ハッシュを実行
        $actual = $instance($stringable, 'md5');
        $expected = hash('md5', 'test', false);
        
        // 結果を検証
        $this->assertEquals($expected, $actual->toString());
    }

    #[Test]
    public function sha256ハッシュアルゴリズムが使用できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('test');
        
        // sha256ハッシュを実行
        $actual = $instance($stringable, 'sha256');
        $expected = hash('sha256', 'test', false);
        
        // 結果を検証
        $this->assertEquals($expected, $actual->toString());
    }

    #[Test]
    public function strlenユーザー関数が使用できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('test');
        
        // strlen関数を使用
        $actual = $instance($stringable, 'strlen');
        $expected = '4';
        
        // 結果を検証
        $this->assertEquals($expected, $actual->toString());
    }

    #[Test]
    public function クロージャが使用できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('test');
        $closure = fn($str) => strtoupper($str);
        
        // クロージャを使用
        $actual = $instance($stringable, $closure);
        $expected = 'TEST';
        
        // 結果を検証
        $this->assertEquals($expected, $actual->toString());
    }

    #[Test]
    public function 無効なハッシャーで例外が発生する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('test');
        
        // 例外が発生することを検証
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid hasher');
        
        // 無効なハッシャーを指定
        $instance($stringable, 123);
    }

    #[Test]
    public function 存在しない関数名で例外が発生する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('test');
        
        // 例外が発生することを検証
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid hasher');
        
        // 存在しない関数名を指定
        $instance($stringable, 'nonexistent_function');
    }

    #[Test]
    public function 無効なハッシュアルゴリズムで例外が発生する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('test');
        
        // 例外が発生することを検証
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid hasher');
        
        // 無効なハッシュアルゴリズムを指定
        $instance($stringable, 'invalid_algorithm');
    }

    #[Test]
    public function 追加引数がパスワードハッシュに渡される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Hash();
        $stringable = new Stringer('password');
        $options = ['cost' => 4];
        
        // オプション付きでbcryptハッシュを実行
        $actual = $instance($stringable, 'bcrypt', $options);
        
        // パスワードが検証できることを確認
        $this->assertTrue(password_verify('password', $actual->toString()));
    }
}