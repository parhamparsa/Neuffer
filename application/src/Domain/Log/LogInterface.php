<?php

declare(strict_types=1);

namespace App\Domain\Log;

interface LogInterface
{
    public function log(array $data, string $fileName): void;
}