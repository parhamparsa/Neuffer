<?php

declare(strict_types=1);

namespace App\Infrastructure\Csv;

use App\Domain\Csv\CsvReaderInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Class responsible for reading CSV files using PhpSpreadsheet.
 *
 * This class implements the CsvReaderInterface and provides functionality to read CSV files. It loads
 * the file, iterates through each row and cell, and returns the data in a structured array format.
 */
class CsvReader implements CsvReaderInterface
{
    /**
     * Reads data from a CSV file and returns it as an array.
     *
     * This method loads the CSV file, iterates through each row and cell, and collects the data into
     * an array where each element corresponds to a row from the CSV. Each row is represented as an array
     * of cell values.
     *
     * @param string $filePath The path to the CSV file to be read.
     *
     * @return array An array of rows, each containing the cell values for that row.
     */
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
