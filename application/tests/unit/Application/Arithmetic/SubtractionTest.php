<?php

namespace App\Tests\unit\Application\Arithmetic;

use App\Application\Arithmetic\Subtraction;
use App\Application\DTO\ArithmeticResult;
use App\Domain\Exception\InvalidOperationException;
use App\Domain\ValueObject\NumberPair;
use PHPUnit\Framework\TestCase;

class SubtractionTest extends TestCase
{
    private Subtraction $subtraction;
    private ArithmeticResult $arithmeticResult;

    protected function setUp(): void
    {
        $this->arithmeticResult = $this->createMock(ArithmeticResult::class);

        $this->subtraction = new Subtraction($this->arithmeticResult);
    }

    public function testValidSubtraction()
    {
        $pair = new NumberPair(10, 5);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('setData')
            ->with(10, 5, 5);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('toArray')
            ->willReturn([10, 5, 5]);

        $result = $this->subtraction->execute($pair);

        $this->assertEquals([10, 5, 5], $result);
    }

    public function testSubtractionWithNegativeResultThrowsException()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The result of subtraction 5 by 10 is less than zero');

        $pair = new NumberPair(5, 10);

        $this->subtraction->execute($pair);
    }

    public function testSubtractionWithNegativeResultThrowsExceptionEdgeCase()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The result of subtraction 0 by 1 is less than zero');

        $pair = new NumberPair(0, 1);

        $this->subtraction->execute($pair);
    }

    public function testSubtractionWithZeroResult()
    {
        $pair = new NumberPair(5, 5);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('setData')
            ->with(5, 5, 0);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('toArray')
            ->willReturn([5, 5, 0]);

        $result = $this->subtraction->execute($pair);

        $this->assertEquals([5, 5, 0], $result);
    }

}