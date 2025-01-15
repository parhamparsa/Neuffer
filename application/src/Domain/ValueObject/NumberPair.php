<?php

namespace App\Domain\ValueObject;

class NumberPair
{
    private int $first_number;
    private int $second_number;

    public function __construct(int $first_number, int $second_number)
    {
        $this->first_number = $first_number;
        $this->second_number = $second_number;
    }

    public function getFirstNumber(): int
    {
        return $this->first_number;
    }

    public function getSecondNumber(): int
    {
        return $this->second_number;
    }
}
