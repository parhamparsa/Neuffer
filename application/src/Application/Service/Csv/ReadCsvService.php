<?php

declare(strict_types=1);

namespace App\Application\Service\Csv;

use App\Domain\Csv\CsvReaderInterface;

readonly class ReadCsvService
{
    public function __construct(private CsvReaderInterface $csvReader)
    {
    }

    public function readCsv(string $filePath): array
    {
        return $this->csvReader->read($filePath);
    }
}
