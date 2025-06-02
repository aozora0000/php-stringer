<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\IsIPv4;
use Stringer\Stringable;
use Stringer\Stringer;

/**
 * IsIPv4クラスのユニットテスト
 */
class IsIPv4Test extends TestCase
{
    #[Test]
    public function 有効なIPv4アドレスでtrueを返す(): void
    {
        $instance = new IsIPv4();
        $stringable = new Stringer('192.168.1.1');

        $actual = $instance($stringable);

        $this->assertTrue($actual);
    }

    #[Test]
    public function 無効なIPアドレスでfalseを返す(): void
    {
        $instance = new IsIPv4();
        $stringable = new Stringer('256.256.256.256');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function 最大値のIPアドレスでtrueを返す(): void
    {
        $instance = new IsIPv4();
        $stringable = new Stringer('255.255.255.255');

        $actual = $instance($stringable);

        $this->assertTrue($actual);
    }

    #[Test]
    public function 最小値のIPアドレスでtrueを返す(): void
    {
        $instance = new IsIPv4();
        $stringable = new Stringer('0.0.0.0');

        $actual = $instance($stringable);

        $this->assertTrue($actual);
    }

    #[Test]
    public function 空文字列でfalseを返す(): void
    {
        $instance = new IsIPv4();
        $stringable = new Stringer('');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function 文字列が含まれるアドレスでfalseを返す(): void
    {
        $instance = new IsIPv4();
        $stringable = new Stringer('192.168.1.abc');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function オクテット数が不足している場合falseを返す(): void
    {
        $instance = new IsIPv4();
        $stringable = new Stringer('192.168.1');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }


    #[Test]
    public function 引数が渡されても正常に動作する(): void
    {
        $instance = new IsIPv4();
        $stringable = new Stringer('10.0.0.1');

        $actual = $instance($stringable, 'extra', 'arguments');

        $this->assertTrue($actual);
    }
}