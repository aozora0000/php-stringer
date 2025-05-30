<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsInteger;
use Stringer\Stringer;

class IsIntegerTest extends TestCase
{
    /**
     * 正の整数の文字列が与えられた場合、trueを返すことを確認
     */
    #[Test]
    public function 正の整数文字列でtrueを返す(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsInteger();

        // Stringableのモックを作成
        $stringable = new Stringer('123');

        $result = $instance($stringable);

        $this->assertTrue($result);
    }

    /**
     * 負の整数の文字列が与えられた場合、trueを返すことを確認
     */
    #[Test]
    public function 負の整数文字列でtrueを返す(): void
    {
        $instance = new IsInteger();

        $stringable = new Stringer('-123');


        $result = $instance($stringable);

        $this->assertTrue($result);
    }

    /**
     * 小数点を含む文字列が与えられた場合、falseを返すことを確認
     */
    #[Test]
    public function 小数点を含む文字列でfalseを返す(): void
    {
        $instance = new IsInteger();

        $stringable = new Stringer('123.45');


        $result = $instance($stringable);

        $this->assertFalse($result);
    }

    /**
     * 数字以外の文字を含む文字列が与えられた場合、falseを返すことを確認
     */
    #[Test]
    public function 数字以外の文字を含む文字列でfalseを返す(): void
    {
        $instance = new IsInteger();

        $stringable = new Stringer('abc123');


        $result = $instance($stringable);

        $this->assertFalse($result);
    }

    /**
     * 空文字列が与えられた場合、falseを返すことを確認
     */
    #[Test]
    public function 空文字列でfalseを返す(): void
    {
        $instance = new IsInteger();

        $stringable = new Stringer('');


        $result = $instance($stringable);

        $this->assertFalse($result);
    }

    /**
     * 指数表記の正の整数が与えられた場合、trueを返すことを確認
     */
    #[Test]
    public function 指数表記の正の整数でtrueを返す(): void
    {
        $instance = new IsInteger();

        $stringable = new Stringer('1e5');

        $result = $instance($stringable);

        $this->assertTrue($result);
    }

    /**
     * 指数表記の負の整数が与えられた場合、trueを返すことを確認
     */
    #[Test]
    public function 指数表記の負の整数でtrueを返す(): void
    {
        $instance = new IsInteger();

        $stringable = new Stringer('-1e5');

        $result = $instance($stringable);

        $this->assertTrue($result);
    }

    /**
     * 正の指数を持つ指数表記の整数が与えられた場合、trueを返すことを確認
     */
    #[Test]
    public function 正の指数を持つ指数表記の整数でtrueを返す(): void
    {
        $instance = new IsInteger();

        $stringable = new Stringer('1e+5');

        $result = $instance($stringable);

        $this->assertTrue($result);
    }

    /**
     * 負の指数を持つ指数表記の整数が与えられた場合、trueを返すことを確認
     */
    #[Test]
    public function 負の指数を持つ指数表記の整数でtrueを返す(): void
    {
        $instance = new IsInteger();

        $stringable = new Stringer('1e-5');

        $result = $instance($stringable);

        $this->assertTrue($result);
    }
}