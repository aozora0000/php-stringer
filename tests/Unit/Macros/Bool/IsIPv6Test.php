<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsIPv6;
use Stringer\Stringer;

/**
 * IsIPv6クラスのテストクラス
 */
class IsIPv6Test extends TestCase
{
    #[Test]
    public function 有効なIPv6アドレスの場合はtrueを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('2001:0db8:85a3:0000:0000:8a2e:0370:7334');
        
        $actual = $instance($stringable);
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function 有効なIPv6ショート形式の場合はtrueを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('2001:db8:85a3::8a2e:370:7334');
        
        $actual = $instance($stringable);
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function ループバックアドレスの場合はtrueを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('::1');
        
        $actual = $instance($stringable);
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function 全てゼロのアドレスの場合はtrueを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('::');
        
        $actual = $instance($stringable);
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function リンクローカルアドレスの場合はtrueを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('fe80::1%eth0');
        
        $actual = $instance($stringable);
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function IPv4マップドIPv6アドレスの場合はtrueを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('::ffff:192.168.1.1');
        
        $actual = $instance($stringable);
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function デュアルスタックアドレスの場合はtrueを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('2001:db8::192.168.1.1');
        
        $actual = $instance($stringable);
        
        $this->assertTrue($actual);
    }

    #[Test]
    public function 無効なIPv6アドレスの場合はfalseを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('invalid_ipv6');
        
        $actual = $instance($stringable);
        
        $this->assertFalse($actual);
    }

    #[Test]
    public function IPv4アドレスの場合はfalseを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('192.168.1.1');
        
        $actual = $instance($stringable);
        
        $this->assertFalse($actual);
    }

    #[Test]
    public function 空文字列の場合はfalseを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('');
        
        $actual = $instance($stringable);
        
        $this->assertFalse($actual);
    }

    #[Test]
    public function 不正な文字が含まれる場合はfalseを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('2001:0db8:85a3::8a2g:370:7334');
        
        $actual = $instance($stringable);
        
        $this->assertFalse($actual);
    }

    #[Test]
    public function セグメントが多すぎる場合はfalseを返す(): void
    {
        $instance = new IsIPv6();
        $stringable = new Stringer('2001:0db8:85a3:0000:0000:8a2e:0370:7334:extra');
        
        $actual = $instance($stringable);
        
        $this->assertFalse($actual);
    }
}