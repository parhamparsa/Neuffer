<?php

declare(strict_types=1);

namespace App\Application\DTO;

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

    public function toArray(): array
    {
        return [
            'firstNumber' => $this->firstNumber,
            'secondNumber' => $this->secondNumber,
            'result' => $this->result,
        ];
    }
}
