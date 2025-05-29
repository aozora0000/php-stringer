<?php

namespace Tests\Stringer\Unit\Macros\Misc;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stringer\Exceptions\InvalidArgumentException;
use Stringer\Macros\Misc\Then;
use Stringer\Stringable;

class ThenTest extends TestCase
{
    #[Test]
    public function 第一引数がnullの場合InvalidArgumentExceptionが投げられる(): void
    {
        // 準備
        $instance = new Then();
        $stringable = $this->createMock(Stringable::class);
        
        // 実行と検証
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("First Argument Then requires a callable");
        
        $instance($stringable, null);
    }

    #[Test]
    public function 第一引数がcallableでない場合InvalidArgumentExceptionが投げられる(): void
    {
        // 準備
        $instance = new Then();
        $stringable = $this->createMock(Stringable::class);
        
        // 実行と検証
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("First Argument Then requires a callable");
        
        $instance($stringable, "not_callable");
    }

    #[Test]
    public function 第二引数がnullの場合InvalidArgumentExceptionが投げられる(): void
    {
        // 準備
        $instance = new Then();
        $stringable = $this->createMock(Stringable::class);
        $firstCallable = fn(): true => true;
        
        // 実行と検証
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Second Argument Then requires a callable");
        
        $instance($stringable, $firstCallable, null);
    }

    #[Test]
    public function 第二引数がcallableでない場合InvalidArgumentExceptionが投げられる(): void
    {
        // 準備
        $instance = new Then();
        $stringable = $this->createMock(Stringable::class);
        $firstCallable = fn(): true => true;
        
        // 実行と検証
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Second Argument Then requires a callable");
        
        $instance($stringable, $firstCallable, "not_callable");
    }

    #[Test]
    public function 第一引数のcallableがtrueを返す場合第二引数のcallableの結果が返される(): void
    {
        // 準備
        $instance = new Then();
        $stringable = $this->createMock(Stringable::class);
        $conditionCallable = fn(Stringable $s): true => true;
        $actionCallable = fn(Stringable $s): string => "transformed_result";
        
        // 実行
        $result = $instance($stringable, $conditionCallable, $actionCallable);
        
        // 検証
        $this->assertEquals("transformed_result", $result);
    }

    #[Test]
    public function 第一引数のcallableがfalseを返す場合元のStringableオブジェクトが返される(): void
    {
        // 準備
        $instance = new Then();
        $stringable = $this->createMock(Stringable::class);
        $conditionCallable = fn(Stringable $s): false => false;
        $actionCallable = fn(Stringable $s): string => "transformed_result";
        
        // 実行
        $result = $instance($stringable, $conditionCallable, $actionCallable);
        
        // 検証
        $this->assertSame($stringable, $result);
    }

    #[Test]
    public function 第一引数のcallableに正しいStringableオブジェクトが渡される(): void
    {
        // 準備
        $instance = new Then();
        $stringable = $this->createMock(Stringable::class);
        $receivedStringable = null;
        
        $conditionCallable = function(Stringable $s) use (&$receivedStringable): false {
            $receivedStringable = $s;
            return false;
        };
        $actionCallable = fn(Stringable $s): string => "result";
        
        // 実行
        $instance($stringable, $conditionCallable, $actionCallable);
        
        // 検証
        $this->assertSame($stringable, $receivedStringable);
    }

    #[Test]
    public function 第二引数のcallableに正しいStringableオブジェクトが渡される(): void
    {
        // 準備
        $instance = new Then();
        $stringable = $this->createMock(Stringable::class);
        $receivedStringable = null;
        
        $conditionCallable = fn(Stringable $s): true => true;
        $actionCallable = function(Stringable $s) use (&$receivedStringable): string {
            $receivedStringable = $s;
            return "result";
        };
        
        // 実行
        $instance($stringable, $conditionCallable, $actionCallable);
        
        // 検証
        $this->assertSame($stringable, $receivedStringable);
    }
}