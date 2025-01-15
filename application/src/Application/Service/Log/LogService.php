<?php

namespace App\Application\Service\Log;

use App\Infrastructure\Log\LogFile;

readonly class LogService
{
    public function __construct(private LogFile $logFile)
    {
    }

    public function logFile(array $data, string $fileName): void
    {
        $this->logFile->log($data, $fileName);
    }
}
