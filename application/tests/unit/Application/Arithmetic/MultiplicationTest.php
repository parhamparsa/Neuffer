<?php

namespace App\Tests\unit\Application\Arithmetic;

use App\Application\Arithmetic\Multiplication;
use App\Application\DTO\ArithmeticResult;
use App\Domain\Exception\InvalidOperationException;
use App\Domain\ValueObject\NumberPair;
use PHPUnit\Framework\TestCase;

class MultiplicationTest extends TestCase
{
    private Multiplication $multiplication;
    private ArithmeticResult $arithmeticResult;

    protected function setUp(): void
    {
        $this->arithmeticResult = $this->createMock(ArithmeticResult::class);

        $this->multiplication = new Multiplication($this->arithmeticResult);
    }

    public function testValidMultiplication()
    {
        $pair = new NumberPair(5, 3);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('setData')
            ->with(5, 3, 15);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('toArray')
            ->willReturn([5, 3, 15]);

        $result = $this->multiplication->execute($pair);

        $this->assertEquals([5, 3, 15], $result);
    }

    public function testNegativeResultThrowsException()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage("The result of multiplication -5 by 3 is less than zero");

        $pair = new NumberPair(-5, 3);

        $this->multiplication->execute($pair);
    }

    public function testZeroResult()
    {
        $pair = new NumberPair(0, 3);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('setData')
            ->with(0, 3, 0);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('toArray')
            ->willReturn([0, 3, 0]);

        $result = $this->multiplication->execute($pair);

        $this->assertEquals([0, 3, 0], $result);
    }
}
