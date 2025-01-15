<?php

declare(strict_types=1);

namespace App\Application\Arithmetic;

use App\Application\DTO\ArithmeticResult;
use App\Domain\Exception\InvalidOperationException;
use App\Domain\ValueObject\NumberPair;

/**
 * Class responsible for handling multiplication operations.
 *
 * This class implements the ArithmeticInterface and provides functionality to
 * perform multiplication on a pair of numbers. It validates the result to ensure
 * it meets application constraints, such as preventing negative results.
 */
readonly class Multiplication implements ArithmeticInterface
{
    /**
     * Constructor for Multiplication.
     *
     * @param ArithmeticResult $arithmeticResult A DTO used to store and return the result of the operation.
     */
    public function __construct(private ArithmeticResult $arithmeticResult)
    {
    }

    /**
     * Determines if the current class supports the given action.
     *
     * @param string $action The action name to check (e.g., 'multiplication').
     *
     * @return bool Returns true if the action is supported, false otherwise.
     */
    public function supports(string $action): bool
    {
        return $action === 'multiplication';
    }


    /**
     * Executes the multiplication operation for the given pair of numbers.
     *
     * This method multiplies the two numbers provided by the NumberPair object.
     * If the result is less than zero, an InvalidOperationException is thrown.
     * The result is then stored in the ArithmeticResult DTO and returned as an array.
     *
     * @param NumberPair $pair The pair of numbers to be multiplied.
     *
     * @return array The result of the multiplication operation, including input numbers and the product.
     *
     * @throws InvalidOperationException If the result of the multiplication is less than zero.
     */
    public function execute(NumberPair $pair): array
    {
        $result = $pair->getFirstNumber() * $pair->getSecondNumber();
        if ($result < 0) {
            throw new InvalidOperationException(sprintf(
                "The result of multiplication %d by %d is less than zero",
                $pair->getFirstNumber(),
                $pair->getSecondNumber()
            ));
        }
        $this->arithmeticResult->setData($pair->getFirstNumber(), $pair->getSecondNumber(), $result);
        return $this->arithmeticResult->toArray();
    }
}
