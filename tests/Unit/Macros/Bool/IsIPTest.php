<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\IsIP;
use Stringer\Stringer;

class IsIPTest extends TestCase
{
    #[Test]
    public function IPv4アドレスの場合はtrueを返す(): void
    {
        $instance = new IsIP();
        $stringable = new Stringer('192.168.1.1');

        $actual = $instance($stringable);

        $this->assertTrue($actual);
    }

    #[Test]
    public function IPv6アドレスの場合はtrueを返す(): void
    {
        $instance = new IsIP();
        $stringable = new Stringer('2001:0db8:85a3:0000:0000:8a2e:0370:7334');

        $actual = $instance($stringable);

        $this->assertTrue($actual);
    }

    #[Test]
    public function IPv4でもIPv6でもない文字列の場合はfalseを返す(): void
    {
        $instance = new IsIP();
        $stringable = new Stringer('not-an-ip-address');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function 空文字列の場合はfalseを返す(): void
    {
        $instance = new IsIP();
        $stringable = new Stringer('');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function 不正なIPv4形式の場合はfalseを返す(): void
    {
        $instance = new IsIP();
        $stringable = new Stringer('256.256.256.256');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function 不正なIPv6形式の場合はfalseを返す(): void
    {
        $instance = new IsIP();
        $stringable = new Stringer('2001:0db8:85a3::8a2e::7334');

        $actual = $instance($stringable);

        $this->assertFalse($actual);
    }

    #[Test]
    public function IPv4のローカルホストアドレスの場合はtrueを返す(): void
    {
        $instance = new IsIP();
        $stringable = new Stringer('127.0.0.1');

        $actual = $instance($stringable);

        $this->assertTrue($actual);
    }

    #[Test]
    public function IPv6のローカルホストアドレスの場合はtrueを返す(): void
    {
        $instance = new IsIP();
        $stringable = new Stringer('::1');

        $actual = $instance($stringable);

        $this->assertTrue($actual);
    }
}