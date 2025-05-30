<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\IsFile;
use Stringer\Stringer;

class IsFileTest extends TestCase
{
    #[Test]
    public function 存在するフルパス文字列の場合はtrueを返す(): void
    {
        $instance = new IsFile();
        $stringable = new Stringer(__FILE__);
        $this->assertTrue($instance($stringable));
    }

    #[Test]
    public function 存在するファイル名とルート引数の場合はtrueを返す(): void
    {
        $instance = new IsFile();
        $stringable = new Stringer(__FILE__);
        $this->assertTrue($instance($stringable->basename(), __DIR__));
    }

    #[Test]
    public function 存在するディレクトリ名の場合はfalseを返す(): void
    {
        $instance = new IsFile();
        $stringable = new Stringer(__DIR__);
        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function 引数なしで空の文字列をチェックした場合にfalseを返す(): void
    {
        $instance = new IsFile();
        $stringable = new Stringer('');

        $this->assertFalse($instance($stringable));
    }

    #[Test]
    public function 存在しないファイルをチェックした場合にfalseを返す(): void
    {
        $instance = new IsFile();
        $stringable = new Stringer('nonexistent-file.txt');

        $this->assertFalse($instance($stringable, '/tmp'));
    }
}