<?php

declare(strict_types=1);

namespace App\Application\Arithmetic;

use App\Application\DTO\ArithmeticResult;
use App\Domain\Exception\InvalidOperationException;
use App\Domain\ValueObject\NumberPair;

readonly class Division implements ArithmeticInterface
{
    public function __construct(private ArithmeticResult $arithmeticResult)
    {
    }

    public function supports(string $action): bool
    {
        return $action === 'division';
    }


    public function execute(NumberPair $pair): array
    {
        try {
            $result = $this->isDivisible($pair->getFirstNumber(), $pair->getSecondNumber());
            $this->arithmeticResult->setData($pair->getFirstNumber(), $pair->getSecondNumber(), $result);
            return $this->arithmeticResult->toArray();
        } catch (InvalidOperationException $e) {
            throw $e;
        }
    }

    private function isDivisible(int $numerator, int $denominator): int
    {
        if ($denominator === 0) {
            throw new InvalidOperationException(
                sprintf(
                    "Division by zero is not allowed. Numbers provided: %d and %d.",
                    $numerator,
                    $denominator
                )
            );
        }

        if ($numerator % $denominator !== 0) {
            throw new InvalidOperationException(
                sprintf(
                    "Numbers %d and %d are not divisible without a remainder.",
                    $numerator,
                    $denominator
                )
            );
        }

        return $numerator / $denominator;
    }
}
