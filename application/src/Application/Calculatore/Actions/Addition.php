<?php

namespace App\Application\Calculator\Actions;

use App\Domain\ValueObject\NumberPair;

class Addition implements ArithmeticInterface
{
    public function execute(NumberPair $pair): NumberPair
    {
        return $pair->getFirstNumber() + $pair->getSecondNumber();
    }
}