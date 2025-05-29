<?php

namespace Tests\Stringer\Unit;

use PHPUnit\Framework\Attributes\Test;
use Stringer\Stringer;

class StringerTest extends TestCase
{
    #[Test]
    public function マクロ機能をテストする(): void
    {
        Stringer::set('test', function($stringer, ...$arguments): string {
            $this->assertInstanceOf(Stringer::class, $stringer);
            $this->assertEmpty($arguments);
            return 'test';
        });
        $instance = new Stringer('aaa');
        $this->assertSame('aaa', $instance->toString());
        $this->assertSame('test', $instance->test());
        $this->assertTrue($instance->has('test'));
        Stringer::remove('test');
        $this->assertFalse($instance->has('test'));;
    }

    #[Test]
    public function マクロとファイルの対応をチェックする(): void
    {
        $macros = Stringer::all();
        $files = glob(__DIR__ . '/../../src/Macros/**/*.php');

        // ファイル名からクラス名を抽出
        $fileClasses = array_map(fn($file): string => basename($file, '.php'), $files);

        // マクロ配列のキーを取得
        $macroNames = array_map(fn($class): string => substr($class, strrpos($class, '\\') + 1), array_values($macros));
        // 差分を検出
        $missingInMacros = array_diff($fileClasses, $macroNames);
        $missingInFiles = array_diff($macroNames, $fileClasses);

        // テストメッセージを作成
        $errorMessage = '';
        if ($missingInMacros !== []) {
            $errorMessage .= "マクロに実装されていないファイルが存在します: " . implode(', ', $missingInMacros) . "\n";
        }

        if ($missingInFiles !== []) {
            $errorMessage .= "ファイルが存在しないマクロが定義されています: " . implode(', ', $missingInFiles);
        }

        $this->assertEmpty($errorMessage, $errorMessage);
    }

    #[Test]
    public function マクロとmethodのdocblockが一致しているか(): void
    {
        $reflection = new \ReflectionClass(Stringer::class);
        $docblock = $reflection->getDocComment();
        foreach(array_keys(Stringer::all()) as $macro) {
            $this->assertStringContainsString($macro, $docblock, $macro . ' not found');
        }
    }

    #[Test]
    public function 全てのマクロでテストケースが書かれている(): void
    {

        // ファイル名からクラス名を抽出
        $fileClasses = array_map(function($file): string {
            return basename($file, '.php');
        }, glob(__DIR__ . '/../../src/Macros/**/*.php'));


        $testClasses = array_map(function($file): string {
            return str_replace('Test', '', basename($file, '.php'));
        }, glob(__DIR__ . '/../../tests/Unit/Macros/**/*.php'));

        // 差分を検出
        $missingInFiles = array_diff($fileClasses, $testClasses);

        // テストメッセージを作成
        $errorMessage = '';
        if ($missingInFiles !== []) {
            $errorMessage .= "テストが存在しないマクロがあります: " . implode(', ', $missingInFiles);
        }

        $this->assertEmpty($errorMessage, $errorMessage);
    }
}