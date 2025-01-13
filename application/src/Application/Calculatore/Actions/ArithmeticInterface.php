<?php

namespace App\Application\Calculator\Actions;

use App\Domain\ValueObject\NumberPair;

interface ArithmeticInterface
{
    public function execute(NumberPair $pair);
}