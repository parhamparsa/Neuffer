<?php

declare(strict_types=1);

namespace App\Infrastructure\Csv;

use App\Domain\Csv\CsvWriterInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Class responsible for writing CSV files using PhpSpreadsheet.
 *
 * This class implements the CsvWriterInterface and provides functionality to write data to CSV files.
 * It creates a directory to store the output files, ensuring the specified folder exists. The CSV files
 * are saved with a timestamp to avoid name collisions.
 */
class CsvWriter implements CsvWriterInterface
{
    // The name of the folder where the CSV files will be stored.
    const FOLDER_NAME = 'final';

    /**
     * Writes the provided data to a CSV file.
     *
     * This method takes an array of data, formats it into a CSV structure using PhpSpreadsheet,
     * and saves it in a designated folder. If the folder doesn't exist, it is created.
     * The file name is appended with a timestamp to avoid overwriting existing files.
     *
     * @param array $data The data to be written to the CSV file. Each element represents a row.
     * @param string $fileName The base name of the CSV file.
     *
     * @return string The file path to the saved CSV file.
     */
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
