<?php

namespace App\Application\Arithmetic;

use App\Domain\ValueObject\NumberPair;

interface ArithmeticInterface
{
    public function execute(NumberPair $pair): array;

    public function supports(string $action): bool;
}
