<?php

namespace App\Application\Factory;

use App\Domain\ValueObject\NumberPair;

class NumberPairFactory
{
    public function create(int $firstNumber, int $secondNumber): NumberPair
    {
        return new NumberPair($firstNumber, $secondNumber);
    }
}