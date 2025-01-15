<?php

namespace App\Tests\unit\Domain\ValueObject;

use App\Domain\ValueObject\NumberPair;
use PHPUnit\Framework\TestCase;

class NumberPairTest extends TestCase
{
    public function testNumberPairStoresValuesCorrectly(): void
    {
        $firstNumber = 10;
        $secondNumber = 20;

        $numberPair = new NumberPair($firstNumber, $secondNumber);

        $this->assertEquals($firstNumber, $numberPair->getFirstNumber());
        $this->assertEquals($secondNumber, $numberPair->getSecondNumber());
    }

    public function testNumberPairWithNegativeValues(): void
    {
        $firstNumber = -10;
        $secondNumber = -20;

        $numberPair = new NumberPair($firstNumber, $secondNumber);

        $this->assertEquals($firstNumber, $numberPair->getFirstNumber());
        $this->assertEquals($secondNumber, $numberPair->getSecondNumber());
    }

    public function testNumberPairWithZeroValues(): void
    {
        $firstNumber = 0;
        $secondNumber = 0;

        $numberPair = new NumberPair($firstNumber, $secondNumber);

        $this->assertEquals($firstNumber, $numberPair->getFirstNumber());
        $this->assertEquals($secondNumber, $numberPair->getSecondNumber());
    }

    public function testNumberPairWithMixedValues(): void
    {
        $firstNumber = 100;
        $secondNumber = -50;

        $numberPair = new NumberPair($firstNumber, $secondNumber);

        $this->assertEquals($firstNumber, $numberPair->getFirstNumber());
        $this->assertEquals($secondNumber, $numberPair->getSecondNumber());
    }
}
