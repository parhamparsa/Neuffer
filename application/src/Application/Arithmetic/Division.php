<?php

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
        $result = $pair->getFirstNumber() - $pair->getSecondNumber();
        if ($result < 0) {
            throw new InvalidOperationException(sprintf(
                "The result of is less %d and %d than zero",
                $pair->getFirstNumber(),
                $pair->getSecondNumber()
            ));
        }
        $this->arithmeticResult->setData($pair->getFirstNumber(), $pair->getSecondNumber(), $result);
        return $this->arithmeticResult->toArray();
    }
}
