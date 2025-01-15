<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\Arithmetic\ArithmeticInterface;

class ArithmeticFactory
{
    private iterable $operations;

    public function __construct(iterable $operations)
    {
        $this->operations = $operations;
    }

    public function getOperation(string $action): ArithmeticInterface
    {
        foreach ($this->operations as $operation) {
            if ($operation->supports($action)) {
                return $operation;
            }
        }

        throw new \InvalidArgumentException("Unsupported operation: $action");
    }

}
