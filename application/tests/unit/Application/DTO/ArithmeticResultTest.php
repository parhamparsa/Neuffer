<?php

namespace App\Tests\unit\Application\DTO;

use App\Application\DTO\ArithmeticResult;
use PHPUnit\Framework\TestCase;

class ArithmeticResultTest extends TestCase
{
    private ArithmeticResult $arithmeticResult;

    protected function setUp(): void
    {
        // Create an instance of ArithmeticResult
        $this->arithmeticResult = new ArithmeticResult();
    }

    public function testSetDataAndToArray(): void
    {
        // Setting the data
        $this->arithmeticResult->setData(10, 2, 5);

        // Convert to array and check the result
        $resultArray = $this->arithmeticResult->toArray();

        // Assertions to verify the data
        $this->assertSame(10, $resultArray['firstNumber']);
        $this->assertSame(2, $resultArray['secondNumber']);
        $this->assertSame(5, $resultArray['result']);
    }

    public function testSetDataWithNegativeNumbers(): void
    {
        // Setting data with negative numbers
        $this->arithmeticResult->setData(-10, 2, -5);

        // Convert to array and check the result
        $resultArray = $this->arithmeticResult->toArray();

        // Assertions to verify the data
        $this->assertSame(-10, $resultArray['firstNumber']);
        $this->assertSame(2, $resultArray['secondNumber']);
        $this->assertSame(-5, $resultArray['result']);
    }
}
