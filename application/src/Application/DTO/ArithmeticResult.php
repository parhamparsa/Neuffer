<?php

declare(strict_types=1);

namespace App\Application\DTO;

/**
 * Data Transfer Object (DTO) for storing arithmetic operation results.
 *
 * This class encapsulates the two numbers involved in an arithmetic operation and the resulting value.
 * It provides methods for setting the data and converting it to an array format for easier use in responses.
 */
class ArithmeticResult
{
    private int $firstNumber;
    private int $secondNumber;
    private int $result;

    public function setData(int $firstNumber, int $secondNumber, float|int $result): void
    {
        $this->firstNumber = $firstNumber;
        $this->secondNumber = $secondNumber;
        $this->result = $result;
    }

    /**
     * Converts the stored data into an array format.
     *
     * This method provides a simple way to retrieve the stored arithmetic operation data as an associative array,
     * suitable for returning responses in API endpoints or logging purposes.
     *
     * @return array An associative array containing the first number, second number, and result.
     */
    public function toArray(): array
    {
        return [
            'firstNumber' => $this->firstNumber,
            'secondNumber' => $this->secondNumber,
            'result' => $this->result,
        ];
    }
}
