<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Stringer\Macros\Bool\IsHTML;
use Stringer\Stringer;

class IsHTMLTest extends TestCase
{
    #[Test]
    public function HTML5のdoctypeを含む文字列がHTMLとして判定される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<!DOCTYPE html><html><head></head><body></body></html>');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertTrue($actual);
    }

    #[Test]
    public function htmlタグを含む文字列がHTMLとして判定される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<html><body>テスト</body></html>');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertTrue($actual);
    }

    #[Test]
    public function divタグを含む文字列がHTMLとして判定される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<div>コンテンツ</div>');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertTrue($actual);
    }

    #[Test]
    public function pタグを含む文字列がHTMLとして判定される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<p>段落テキスト</p>');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertTrue($actual);
    }

    #[Test]
    public function aタグを含む文字列がHTMLとして判定される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<a href="https://example.com">リンク</a>');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertTrue($actual);
    }

    #[Test]
    public function imgタグを含む文字列がHTMLとして判定される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<img src="image.jpg" alt="画像">');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertTrue($actual);
    }

    #[Test]
    public function scriptタグを含む文字列がHTMLとして判定される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<script>console.log("test");</script>');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertTrue($actual);
    }

    #[Test]
    public function 大文字のHTMLタグを含む文字列がHTMLとして判定される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<DIV>大文字タグ</DIV>');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertTrue($actual);
    }

    #[Test]
    public function プレーンテキストはHTMLとして判定されない(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('これは普通のテキストです');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertFalse($actual);
    }

    #[Test]
    public function 空文字列はHTMLとして判定されない(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertFalse($actual);
    }

    #[Test]
    public function 不完全なHTMLタグはHTMLとして判定されない(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<div 不完全なタグ');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertFalse($actual);
    }

    #[Test]
    public function HTMLエンティティのみの文字列はHTMLとして判定されない(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('&lt;div&gt;エンティティ&lt;/div&gt;');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertFalse($actual);
    }

    #[Test]
    public function 対象外のタグを含む文字列はHTMLとして判定されない(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<customtag>カスタムタグ</customtag>');

        // 実際の値を取得
        $actual = $instance($stringable);

        // アサーション
        $this->assertFalse($actual);
    }

    #[Test]
    public function 指定したタグのみがHTMLとして判定される(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<p>段落</p>');

        // 実際の値を取得
        $actual = $instance($stringable, 'p');

        // アサーション
        $this->assertTrue($actual);
    }

    #[Test]
    public function 指定したタグ以外はHTMLとして判定されない(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new IsHTML();
        // Stringerクラスのインスタンスを作成
        $stringable = new Stringer('<div>コンテンツ</div>');

        // 実際の値を取得
        $actual = $instance($stringable, 'p');

        // アサーション
        $this->assertFalse($actual);
    }
}