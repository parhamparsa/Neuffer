<?php

declare(strict_types=1);

namespace App\Application\Service\Csv;

use App\Domain\Csv\CsvWriterInterface;

readonly class WriteCsvService
{
    public function __construct(private CsvWriterInterface $csvWriter)
    {
    }

    public function writeCsv(array $data, string $fileName): string
    {
        return $this->csvWriter->write($data, $fileName);
    }
}
