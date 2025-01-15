<?php

declare(strict_types=1);

namespace App\Domain\Csv;

interface CsvReaderInterface
{
    public function read(string $filePath): array;
}
