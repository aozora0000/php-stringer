<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\HashEqual;
use Stringer\Stringer;

class HashEqualTest extends TestCase
{
    #[Test]
    public function 同じ文字列のSHA1ハッシュが等しいことを確認(): void
    {
        $instance = new HashEqual();
        $stringable = new Stringer('356a192b7913b04c54574d18c28d46e6395428ab'); // "1"のSHA1ハッシュ
        
        $actual = $instance($stringable, 'sha1', '1');
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function 異なる文字列のSHA1ハッシュが等しくないことを確認(): void
    {
        $instance = new HashEqual();
        $stringable = new Stringer('356a192b7913b04c54574d18c28d46e6395428ab'); // "1"のSHA1ハッシュ
        
        $actual = $instance($stringable, 'sha1', '2');
        
        $this->assertFalse($actual);
    }

    #[Test]
    public function デフォルトのハッシュアルゴリズムがSHA1であることを確認(): void
    {
        $instance = new HashEqual();
        $stringable = new Stringer('356a192b7913b04c54574d18c28d46e6395428ab'); // "1"のSHA1ハッシュ
        
        $actual = $instance($stringable, '', '1');
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function MD5ハッシュで同じ文字列が等しいことを確認(): void
    {
        $instance = new HashEqual();
        $stringable = new Stringer('c4ca4238a0b923820dcc509a6f75849b'); // "1"のMD5ハッシュ
        
        $actual = $instance($stringable, 'md5', '1');
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function SHA256ハッシュで同じ文字列が等しいことを確認(): void
    {
        $instance = new HashEqual();
        $stringable = new Stringer('6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'); // "1"のSHA256ハッシュ
        
        $actual = $instance($stringable, 'sha256', '1');
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function 空のターゲット値でデフォルトの空文字列が使用されることを確認(): void
    {
        $instance = new HashEqual();
        $stringable = new Stringer('da39a3ee5e6b4b0d3255bfef95601890afd80709'); // 空文字列のSHA1ハッシュ
        
        $actual = $instance($stringable, 'sha1');
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function Argon2iがサポートされていない場合に例外が発生することを確認(): void
    {
        $instance = new HashEqual();
        $stringable = new Stringer('test');
        
        // PASSWORD_ARGON2Iが定義されていない環境をシミュレート
        if (defined('PASSWORD_ARGON2I')) {
            $this->markTestSkipped('PASSWORD_ARGON2I is defined');
        }
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Argon2i is not supported');
        
        $instance($stringable, 'argon2i', 'test');
    }

    #[Test]
    public function 追加の引数がHashクラスに渡されることを確認(): void
    {
        $instance = new HashEqual();
        $stringable = new Stringer('c4ca4238a0b923820dcc509a6f75849b'); // "1"のMD5ハッシュ
        
        $actual = $instance($stringable, 'md5', '1', 'additional_arg');

        $this->assertTrue($actual);
    }

    #[Test]
    public function 無効なハッシュアルゴリズムで例外が投げられる(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid hasher: invalid_algorithm');
        $instance = new HashEqual();
        $stringable = new Stringer('invalid_hash');
        
        $instance($stringable, 'invalid_algorithm', 'test');
    }

    #[Test]
    public function bcryptハッシュで同じ文字列が等しいことを確認(): void
    {
        $instance = new HashEqual();
        $password = 'test_password';
        $stringable = (new Stringer($password))->hash('bcrypt', $password);

        $actual = $instance($stringable, 'bcrypt', $password);

        $this->assertTrue($actual);
    }

    #[Test]
    public function クロージャハッシュで同じ文字列が等しいことを確認(): void
    {
        $instance = new HashEqual();
        $hasher = fn($str) => strtoupper($str);
        $stringable = new Stringer('TEST');

        $actual = $instance($stringable, $hasher, 'test');

        $this->assertTrue($actual);
    }
}