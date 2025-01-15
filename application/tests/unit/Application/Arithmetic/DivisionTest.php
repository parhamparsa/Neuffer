<?php

declare(strict_types=1);

namespace App\Tests\unit\Application\Arithmetic;

use App\Application\Arithmetic\Division;
use App\Application\DTO\ArithmeticResult;
use App\Domain\Exception\InvalidOperationException;
use App\Domain\ValueObject\NumberPair;
use PHPUnit\Framework\TestCase;

class DivisionTest extends TestCase
{
    private Division $division;
    private ArithmeticResult $arithmeticResult;

    protected function setUp(): void
    {
        $this->arithmeticResult = $this->createMock(ArithmeticResult::class);

        $this->division = new Division($this->arithmeticResult);
    }

    public function testValidDivision()
    {
        $pair = new NumberPair(10, 5);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('setData')
            ->with(10, 5, 2);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('toArray')
            ->willReturn([10, 5, 2]);

        $result = $this->division->execute($pair);

        $this->assertEquals([10, 5, 2], $result);
    }

    public function testDivisionByZeroThrowsException()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Division by zero is not allowed. Numbers provided: 10 and 0.');

        $pair = new NumberPair(10, 0);

        $this->division->execute($pair);
    }

    public function testDivisionWithRemainderThrowsException()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Numbers 10 and 3 are not divisible without a remainder.');

        $pair = new NumberPair(10, 3);

        $this->division->execute($pair);
    }

    public function testValidDivisionWithNegativeResult()
    {
        $pair = new NumberPair(-10, 5);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('setData')
            ->with(-10, 5, -2);

        $this->arithmeticResult
            ->expects($this->once())
            ->method('toArray')
            ->willReturn([-10, 5, -2]);

        $result = $this->division->execute($pair);

        $this->assertEquals([-10, 5, -2], $result);
    }
}
