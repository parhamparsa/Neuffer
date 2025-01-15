<?php

namespace App\Infrastructure\Csv;

use App\Domain\Csv\CsvReaderInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CsvReader implements CsvReaderInterface
{
    public function read(string $filePath): array
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = [];

        foreach ($sheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $rowValues = [];
            foreach ($cellIterator as $cell) {
                $rowValues[] = $cell->getFormattedValue();
            }

            $rows[] = $rowValues;
        }

        return $rows;
    }
}