<?php

namespace App\Application\Factory;

use App\Domain\ValueObject\NumberPair;
use function PHPUnit\Framework\isNumeric;

class NumberPairFactory
{
    /**
     * @throws \Exception
     */
    public function create(int $firstNumber, int $secondNumber): NumberPair
    {
        if (!is_numeric($firstNumber) || !is_numeric($secondNumber)) {
            throw new \Exception(sprintf(
                'firstNumber %s and secondNumber %s must be numeric',
                $firstNumber,
                $secondNumber
            ));
        }

        return new NumberPair($firstNumber, $secondNumber);
    }
}