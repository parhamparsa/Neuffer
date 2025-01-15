<?php

namespace unit\Application\Arithmetic;

use App\Application\Arithmetic\Addition;
use App\Application\DTO\ArithmeticResult;
use App\Domain\Exception\InvalidOperationException;
use App\Domain\ValueObject\NumberPair;
use PHPUnit\Framework\TestCase;

class AdditionTest extends TestCase
{
    private ArithmeticResult $arithmeticResult;
    private Addition $addition;

    protected function setUp(): void
    {
        $this->arithmeticResult = $this->createMock(ArithmeticResult::class);

        $this->addition = new Addition($this->arithmeticResult);
    }

    public function testSupportsAdditionAction(): void
    {
        $this->assertTrue($this->addition->supports('addition'));
        $this->assertFalse($this->addition->supports('subtraction'));
    }

    public function testExecuteValidAddition(): void
    {
        $pair = $this->createMock(NumberPair::class);
        $pair->method('getFirstNumber')->willReturn(5);
        $pair->method('getSecondNumber')->willReturn(10);

        $this->arithmeticResult->expects($this->once())
            ->method('setData')
            ->with(5, 10, 15);
        $this->arithmeticResult->expects($this->once())
            ->method('toArray')
            ->willReturn(['first' => 5, 'second' => 10, 'result' => 15]);

        $result = $this->addition->execute($pair);
        $this->assertEquals(['first' => 5, 'second' => 10, 'result' => 15], $result);
    }

    public function testExecuteInvalidAdditionThrowsException(): void
    {
        $pair = $this->createMock(NumberPair::class);
        $pair->method('getFirstNumber')->willReturn(-5);
        $pair->method('getSecondNumber')->willReturn(-10);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage("The result of addition -5 by -10 is less than zero");

        $this->addition->execute($pair);
    }
}