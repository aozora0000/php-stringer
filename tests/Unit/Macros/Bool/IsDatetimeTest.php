<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsDatetime;
use Stringer\Stringer;

/**
 * IsDatetimeクラスのユニットテスト
 */
class IsDatetimeTest extends TestCase
{
    #[Test]
    public function 有効な日付文字列の場合trueを返す(): void
    {
        // 準備
        $instance = new IsDatetime();
        $stringable = new Stringer('2023-12-25');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertTrue($actual);
    }

    #[Test]
    public function 有効な日時文字列の場合trueを返す(): void
    {
        // 準備
        $instance = new IsDatetime();
        $stringable = new Stringer('2023-12-25 15:30:45');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertTrue($actual);
    }

    #[Test]
    public function ISO8601形式の日時文字列の場合trueを返す(): void
    {
        // 準備
        $instance = new IsDatetime();
        $stringable = new Stringer('2023-12-25T15:30:45Z');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertTrue($actual);
    }

    #[Test]
    public function 相対的な日時文字列の場合trueを返す(): void
    {
        // 準備
        $instance = new IsDatetime();
        $stringable = new Stringer('now');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertTrue($actual);
    }

    #[Test]
    public function 昨日を表す文字列の場合trueを返す(): void
    {
        // 準備
        $instance = new IsDatetime();
        $stringable = new Stringer('yesterday');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertTrue($actual);
    }

    #[Test]
    public function 無効な日付文字列の場合falseを返す(): void
    {
        // 準備
        $instance = new IsDatetime();
        $stringable = new Stringer('invalid-date');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertFalse($actual);
    }

    #[Test]
    public function 空文字列の場合falseを返す(): void
    {
        // 準備
        $instance = new IsDatetime();
        $stringable = new Stringer('');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertFalse($actual);
    }

    #[Test]
    public function 数値のみの文字列の場合falseを返す(): void
    {
        // 準備
        $instance = new IsDatetime();
        $stringable = new Stringer('12345');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertFalse($actual);
    }

    #[Test]
    public function 文字のみの文字列の場合falseを返す(): void
    {
        // 準備
        $instance = new IsDatetime();
        $stringable = new Stringer('hello world');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertFalse($actual);
    }

    #[Test]
    public function 不正な日付形式の場合falseを返す(): void
    {
        // 準備
        $instance = new IsDatetime();
        $stringable = new Stringer('2023-13-45');
        
        // 実行
        $actual = $instance($stringable);
        
        // 検証
        $this->assertFalse($actual);
    }
}