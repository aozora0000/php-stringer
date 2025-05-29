<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Snake;
use Stringer\Stringable;
use Stringer\Stringer;

/**
 * Snakeクラスのユニットテスト
 */
class SnakeTest extends TestCase
{
    /**
     * すでに全て小文字の文字列の場合、そのまま返される事を確認する
     */
    #[Test]
    public function すべて小文字の場合そのまま返す(): void
    {
        $instance = new Stringer('exampleword');

        $this->assertSame('exampleword', $instance->snake()->toString());
    }

    /**
     * 小文字以外の文字列が渡された場合、snake caseへ変換されて返却される事を確認する
     */
    #[Test]
    public function 大文字混在の場合スネークケースに変換する(): void
    {
        $instance = new Stringer('ExampleWord');

        $this->assertSame('example_word', $instance->snake()->toString());
    }

    #[Test]
    public function 空白を削除してスネークケースに変換する(): void
    {
        $instance = new Stringer('Example Word');

        $this->assertSame('example_word', $instance->snake()->toString());
    }

    #[Test]
    public function 区切り文字指定でハイフンを使うこと(): void
    {
        $instance = new Stringer('ExampleWord');
        $this->assertSame('example-word', $instance->snake('-')->toString());
    }
}