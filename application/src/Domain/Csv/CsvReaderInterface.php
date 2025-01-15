<?php

namespace App\Domain\Csv;

interface CsvReaderInterface
{
    public function read(string $filePath): array;
}
