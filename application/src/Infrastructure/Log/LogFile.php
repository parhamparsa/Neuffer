<?php

declare(strict_types=1);

namespace App\Infrastructure\Log;

use App\Domain\Log\LogInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class LogFile implements LogInterface
{
    const FOLDER_NAME = 'final';

    public function __construct(private readonly Filesystem $filesystem)
    {
    }

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
                    fputcsv($file, $row);  // Converts each array row to a CSV line
                } else {
                    // If any row is not an array, treat it as a single value (for example, a string)
                    fputcsv($file, [$row]);  // Wrap the value in an array
                }
            }
            fclose($file);
        } catch (IOExceptionInterface $exception) {
            throw new IOException($exception->getMessage());
        }
    }
}
