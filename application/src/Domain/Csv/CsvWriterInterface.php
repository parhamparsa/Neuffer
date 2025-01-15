<?php

declare(strict_types=1);

namespace App\Domain\Csv;

interface CsvWriterInterface
{
    public function write(array $data, string $fileName): string;
}
