<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsEmail;
use Stringer\Stringer;

/**
 * IsEmailクラスのユニットテスト
 */
class IsEmailTest extends TestCase
{
    #[Test]
    public function 有効なメールアドレス形式でDNSレコードが存在する場合にtrueを返す(): void
    {
        // 実在するドメインのメールアドレスを使用
        $instance = new IsEmail();
        $stringable = new Stringer('test@gmail.com');

        $actual = $instance($stringable);

        $this->assertTrue($actual);
    }

    #[Test]
    public function 無効なメールアドレス形式の場合にfalseを返す(): void
    {
        $instance = new IsEmail();
        $stringable = new Stringer('invalid-email');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function メールアドレス形式だが無効な文字が含まれる場合にfalseを返す(): void
    {
        $instance = new IsEmail();
        $stringable = new Stringer('test@invalid..domain.com');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function アットマークがないメールアドレス形式の場合にfalseを返す(): void
    {
        $instance = new IsEmail();
        $stringable = new Stringer('testexample.com');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function 空文字列の場合にfalseを返す(): void
    {
        $instance = new IsEmail();
        $stringable = new Stringer('');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function ローカル部が空のメールアドレスの場合にfalseを返す(): void
    {
        $instance = new IsEmail();
        $stringable = new Stringer('@example.com');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function ドメイン部が空のメールアドレスの場合にfalseを返す(): void
    {
        $instance = new IsEmail();
        $stringable = new Stringer('test@');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function 有効なメールアドレス形式だが存在しないドメインの場合にfalseを返す(): void
    {
        $instance = new IsEmail();
        // 存在しない可能性が高いドメインを使用
        $stringable = new Stringer('test@nonexistentdomain12345.com');
        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function 複数のアットマークを含むメールアドレスの場合にfalseを返す(): void
    {
        $instance = new IsEmail();
        $stringable = new Stringer('test@@example.com');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function スペースを含むメールアドレスの場合にfalseを返す(): void
    {
        $instance = new IsEmail();
        $stringable = new Stringer('test @example.com');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }
}