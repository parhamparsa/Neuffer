<?php

declare(strict_types=1);

namespace App\Application\Arithmetic;

use App\Application\DTO\ArithmeticResult;
use App\Domain\Exception\InvalidOperationException;
use App\Domain\ValueObject\NumberPair;

/**
 * Class responsible for handling division operations.
 *
 * This class implements the ArithmeticInterface and provides functionality to
 * perform division on a pair of numbers. It ensures that the division is valid,
 * checking for divisibility and preventing division by zero.
 */
readonly class Division implements ArithmeticInterface
{
    /**
     * Constructor for Division.
     *
     * @param ArithmeticResult $arithmeticResult A DTO used to store and return the result of the operation.
     */
    public function __construct(private ArithmeticResult $arithmeticResult)
    {
    }

    /**
     * Determines if the current class supports the given action.
     *
     * @param string $action The action name to check (e.g., 'division').
     *
     * @return bool Returns true if the action is supported, false otherwise.
     */
    public function supports(string $action): bool
    {
        return $action === 'division';
    }


    /**
     * Executes the division operation for the given pair of numbers.
     *
     * This method checks divisibility, prevents division by zero, and calculates the division.
     * If any condition is violated, an InvalidOperationException is thrown. The result is stored
     * in the ArithmeticResult DTO and returned as an array.
     *
     * @param NumberPair $pair The pair of numbers to be divided.
     *
     * @return array The result of the division operation, including input numbers and the quotient.
     *
     * @throws InvalidOperationException If division by zero occurs or if the numbers are not divisible without a remainder.
     */
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

    /**
     * Checks if the given numbers are divisible without a remainder and performs the division.
     *
     * This method prevents division by zero and ensures the numerator is divisible by the denominator
     * without leaving a remainder. If either condition fails, an InvalidOperationException is thrown.
     *
     * @param int $numerator The number to be divided (dividend).
     * @param int $denominator The number to divide by (divisor).
     *
     * @return int The quotient of the division.
     *
     * @throws InvalidOperationException If division by zero occurs or if the numbers are not divisible without a remainder.
     */
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
