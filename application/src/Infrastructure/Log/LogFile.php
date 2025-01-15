<?php

declare(strict_types=1);

namespace App\Infrastructure\Log;

use App\Domain\Log\LogInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class responsible for logging data to a file.
 *
 * This class implements the LogInterface and provides functionality to log data to a text file.
 * The file is saved within a directory, and the data is written as CSV-like lines.
 */
class LogFile implements LogInterface
{
    const FOLDER_NAME = 'final';

    public function __construct(private readonly Filesystem $filesystem)
    {
    }

    /**
     * Logs data to a file.
     *
     * This method writes the provided data to a text file. The data is written row by row. If the row
     * is an array, each element will be written as a CSV line. If a row is a single value, it will be wrapped
     * in an array and treated as a CSV line as well. The log file is named using the provided filename and
     * the current timestamp to ensure uniqueness.
     *
     * @param array  $data The data to be logged, where each item represents a row of information.
     * @param string $fileName The base name of the log file.
     *
     * @throws IOException If there is an error writing to the file or creating directories.
     */
    public function log(array $data, string $fileName): void
    {
        try {
            $outputFilePath = sprintf(self::FOLDER_NAME . '/' . $fileName . '_%s.txt', time());

            $directory = dirname(self::FOLDER_NAME . '/');
            if (!$this->filesystem->exists($directory)) {
                $this->filesystem->mkdir($directory);
            }

            $file = fopen($outputFilePath, 'w');

            foreach ($data as $row) {
                if (is_array($row)) {
                    fputcsv($file, $row);
                } else {
                    fputcsv($file, [$row]);
                }
            }
            fclose($file);
        } catch (IOExceptionInterface $exception) {
            throw new IOException($exception->getMessage());
        }
    }
}
