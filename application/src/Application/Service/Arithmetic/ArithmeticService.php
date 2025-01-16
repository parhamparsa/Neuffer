<?php

declare(strict_types=1);

namespace App\Application\Service\Arithmetic;

use App\Application\Factory\ArithmeticFactory;
use App\Application\Factory\NumberPairFactory;
use App\Application\Service\Csv\ReadCsvService;
use App\Application\Service\Csv\WriteCsvService;
use App\Application\Service\Log\LogService;
use App\Domain\Exception\InvalidOperationException;
use App\Infrastructure\Uuid\UuidGenerator;
use Exception;

readonly class ArithmeticService
{
    public function __construct(private ReadCsvService    $readCsvService,
                                private WriteCsvService   $writeCsvService,
                                private LogService        $logService,
                                private ArithmeticFactory $arithmeticFactory,
                                private NumberPairFactory $numberPairFactory,
                                private UuidGenerator     $uuidGenerator,
    )
    {
    }

    public function Process(string $filePath, string $action): void
    {
        $result = [];
        $log = [];
        $fileName = $this->generateFileName();

        try {
            $data = $this->readCsvService->readCsv($filePath);
            $operation = $this->arithmeticFactory->getOperation($action);

            foreach ($data as $row) {
                try {
                    $pair = $this->numberPairFactory->create((int)$row[0], (int)$row[1]);
                    $result[] = $operation->execute($pair);
                } catch (InvalidOperationException $exception) {
                    $log[] = $exception->getMessage();
                }
            }

            $this->writeCsvService->writeCsv($result, $fileName);

            if (!empty($log)) {
                $this->logService->logFile($log, $fileName);
            }
        } catch (\Exception $exception) {
            throw new Exception("An error occurred during processing: " . $exception->getMessage(), 0, $exception);
        }
    }

    private function generateFileName(): string
    {
        return $this->uuidGenerator->generateUuid();
    }
}
