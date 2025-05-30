<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\IsClassMethod;
use Stringer\Stringer;

class IsClassMethodTest extends TestCase
{
    #[Test]
    public function 存在するクラスと存在するメソッドの組み合わせでtrueを返す(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('DateTime::format');

        $this->assertTrue($instance($stringable));
    }

    #[Test]
    public function 存在するクラスと存在しないメソッドの組み合わせでfalseを返す(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('DateTime::nonExistentMethod');

        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function 存在しないクラスと任意のメソッドの組み合わせでfalseを返す(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('NonExistentClass::someMethod');

        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function セパレータが含まれていない文字列でfalseを返す(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('DateTimeformat');

        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function カスタムセパレータを使用して存在するクラスメソッドを判定する(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('DateTime->format');

        $this->assertTrue($instance($stringable, '->'));
    }

    #[Test]
    public function カスタムセパレータを使用して存在しないクラスメソッドを判定する(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('NonExistent->method');

        $this->assertFalse($instance($stringable, '->'));
    }

    #[Test]
    public function カスタムセパレータが文字列に含まれていない場合falseを返す(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('DateTime::format');

        $this->assertFalse($instance($stringable, '->'));
    }

    #[Test]
    public function 空文字列の場合falseを返す(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('');

        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function セパレータのみの文字列でfalseを返す(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('::');

        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function クラス名のみでメソッド名が空の場合falseを返す(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('DateTime::');

        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function メソッド名のみでクラス名が空の場合falseを返す(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('::format');

        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function 静的メソッドの存在を正しく判定する(): void
    {
        $instance = new IsClassMethod();
        $stringable = new Stringer('DateTime::createFromFormat');

        $this->assertTrue($instance($stringable));
    }
}