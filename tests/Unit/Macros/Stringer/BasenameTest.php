<?php

namespace Tests\Stringer\Unit\Macros\Stringer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Macros\Stringer\Basename;
use Stringer\Stringer;

/**
 * Basenameクラスのテストクラス
 */
class BasenameTest extends TestCase
{
    #[Test]
    public function 空文字列の場合例外が発生する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Basename();
        
        // 空文字列のStringerインスタンスを作成
        $emptyString = new Stringer('');
        
        // 例外が発生することを期待
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('String is empty');
        
        // テスト実行
        $instance($emptyString);
    }



    #[Test]
    public function ファイルパスからファイル名のみが取得できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Basename();
        
        // テスト用のファイルパスを含むStringerインスタンスを作成
        $filePath = new Stringer('/path/to/file.txt');
        
        // 期待値
        $expected = 'file.txt';
        
        // テスト実行
        $actual = $instance($filePath)->toString();
        
        // アサーション
        $this->assertEquals($expected, $actual);
    }
    
    #[Test]
    public function ディレクトリパスからディレクトリ名が取得できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Basename();
        
        // テスト用のディレクトリパスを含むStringerインスタンスを作成
        $directoryPath = new Stringer('/path/to/directory');
        
        // 期待値
        $expected = 'directory';
        
        // テスト実行
        $actual = $instance($directoryPath)->toString();
        
        // アサーション
        $this->assertEquals($expected, $actual);
    }
    
    #[Test]
    public function 拡張子なしのファイル名が取得できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Basename();
        
        // テスト用のファイルパスを含むStringerインスタンスを作成
        $filePath = new Stringer('/home/user/document');
        
        // 期待値
        $expected = 'document';
        
        // テスト実行
        $actual = $instance($filePath)->toString();
        
        // アサーション
        $this->assertEquals($expected, $actual);
    }
    
    #[Test]
    public function ルートディレクトリの場合は空文字が取得できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Basename();
        
        // テスト用のルートパスを含むStringerインスタンスを作成
        $rootPath = new Stringer('/');
        
        // 期待値
        $expected = '';
        
        // テスト実行
        $actual = $instance($rootPath)->toString();
        
        // アサーション
        $this->assertEquals($expected, $actual);
    }
    
    #[Test]
    public function 複数のスラッシュを含むパスでも正しく動作する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Basename();
        
        // テスト用の複数スラッシュを含むパスのStringerインスタンスを作成
        $pathWithMultipleSlashes = new Stringer('/path//to///file.php');
        
        // 期待値
        $expected = 'file.php';
        
        // テスト実行
        $actual = $instance($pathWithMultipleSlashes)->toString();
        
        // アサーション
        $this->assertEquals($expected, $actual);
    }

    
    #[Test]
    public function Windowsスタイルのパスでも正しく動作する(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Basename();
        
        // テスト用のWindowsスタイルパスを含むStringerインスタンスを作成
        $windowsPath = new Stringer('C:\\Users\\username\\file.txt');
        
        // 期待値
        $expected = 'file.txt';
        
        // テスト実行
        $actual = $instance($windowsPath)->toString();
        
        // アサーション
        $this->assertEquals($expected, $actual);
    }

    #[Test]
    public function URLからファイル名が取得できる(): void
    {
        // テスト対象のインスタンスを作成
        $instance = new Basename();

        // テスト用のURLを含むStringerインスタンスを作成
        $url = new Stringer('https://example.com/path/to/document.pdf');

        // 期待値
        $expected = 'document.pdf';

        // テスト実行
        $actual = $instance($url)->toString();

        // アサーション
        $this->assertEquals($expected, $actual);
    }
}