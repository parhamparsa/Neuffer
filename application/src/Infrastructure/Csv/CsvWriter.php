<?php

declare(strict_types=1);

namespace App\Infrastructure\Csv;

use App\Domain\Csv\CsvWriterInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CsvWriter implements CsvWriterInterface
{
    const FOLDER_NAME = 'final';

    public function write(array $data, string $fileName): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $rowIndex = 1;
        foreach ($data as $row) {
            $sheet->fromArray($row, null, "A{$rowIndex}");
            $rowIndex++;
        }
        if (!is_dir(self::FOLDER_NAME)) {
            mkdir(self::FOLDER_NAME, 0755, true);
        }

        $outputFilePath = sprintf(self::FOLDER_NAME . '/' . $fileName . '_%s.csv', time());
        $writer = IOFactory::createWriter($spreadsheet, 'Csv');
        $writer->save($outputFilePath);

        return $outputFilePath;
    }
}
