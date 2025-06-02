<?php

namespace Tests\Stringer\Unit\Macros\Bool;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Bool\IsUrl;
use Stringer\Stringable;
use Stringer\Stringer;

class IsUrlTest extends TestCase
{
    /**
     * 有効なhttp URLの場合にtrueが返ることを確認する
     */
    #[Test]
    public function httpスキームのURLを判定できる(): void
    {
        $stringable = new Stringer('http://example.com');

        $isUrl = new IsUrl();
        $this->assertTrue($isUrl($stringable));
    }

    /**
     * 有効なhttps URLの場合にtrueが返ることを確認する
     */
    #[Test]
    public function httpsスキームのURLを判定できる(): void
    {
        $stringable = new Stringer('https://example.com/path/hoge?param=piyo#frag1');

        $isUrl = new IsUrl();
        $this->assertTrue($isUrl($stringable));
    }

    /**
     * ftpスキームのURLを判定できることを確認する
     */
    #[Test]
    public function ftpスキームのURLを判定できる(): void
    {
        $stringable = new Stringer('ftp://example.com/');

        $isUrl = new IsUrl();
        $this->assertTrue($isUrl($stringable, 'ftp'));
    }

    /**
     * sftpスキームのURLを判定できることを確認する
     */
    #[Test]
    public function sftpスキームのURLを判定できる(): void
    {
        $stringable = new Stringer('sftp://example.com/');

        $isUrl = new IsUrl();
        $this->assertTrue($isUrl($stringable, 'sftp'));
    }

    /**
     * 不正な形式のURLではfalseが返ることを確認する
     */
    #[Test]
    public function 不正なURLは認識されない(): void
    {
        $stringable = new Stringer('http://');

        $isUrl = new IsUrl();
        $this->assertFalse($isUrl($stringable));
    }

    /**
     * IPアドレスによるURLを判定できることを確認する
     */
    #[Test]
    public function IPアドレスのURLを判定できる(): void
    {
        $stringable = new Stringer('https://127.0.0.1/hoge');

        $isUrl = new IsUrl();
        $this->assertTrue($isUrl($stringable));
    }

    /**
     * ユーザー情報付きURLが認識できることを確認する
     */
    #[Test]
    public function ユーザー情報付きURLを判定できる(): void
    {
        $stringable = new Stringer('https://user:pass@example.com/path');

        $isUrl = new IsUrl();
        $this->assertTrue($isUrl($stringable));
    }

    /**
     * ポート番号付きURLが認識できることを確認する
     */
    #[Test]
    public function ポート番号付きURLを判定できる(): void
    {
        $stringable = new Stringer('https://example.com:8080/');

        $isUrl = new IsUrl();
        $this->assertTrue($isUrl($stringable));
    }

    /**
     * IPv6アドレスURLが認識できることを確認する
     */
    #[Test]
    public function IPv6アドレスのURLを判定できる(): void
    {
        $stringable = new Stringer('http://[2001:db8::1]/index.html');

        $isUrl = new IsUrl();
        $this->assertTrue($isUrl($stringable));
    }

    /**
     * ドメイン名無し文字列は認識されないことを確認する
     */
    #[Test]
    public function ドメイン名無しは認識されない(): void
    {
        $stringable = new Stringer('http:///hoge');

        $isUrl = new IsUrl();
        $this->assertFalse($isUrl($stringable));
    }
}