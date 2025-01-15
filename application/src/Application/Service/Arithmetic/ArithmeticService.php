<?php

namespace App\Application\Service\Arithmetic;

use App\Application\Factory\ArithmeticFactory;
use App\Application\Factory\NumberPairFactory;
use App\Application\Service\Csv\ReadCsvService;
use App\Application\Service\Csv\WriteCsvService;
use App\Application\Service\Log\LogService;
use App\Domain\Exception\InvalidOperationException;
use App\Infrastructure\Uuid\UuidGenerator;

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

    public function Process(string $filePath, string $action): array
    {
        $result = [];
        $log = [];
        $fileName = $this->generateFileName();
        $data = $this->readCsvService->readCsv($filePath);
        $operation = $this->arithmeticFactory->getOperation($action);
        foreach ($data as $row) {
            try {
                $pair = $this->numberPairFactory->create($row[0], $row[1]);
                $result[] = $operation->execute($pair);
            } catch (InvalidOperationException $exception) {
                $log[] = $exception->getMessage();
            } catch (\Throwable $exception) {
                dump($exception->getMessage());
            }
        }

        $this->writeCsvService->writeCsv($result, $fileName);
        if (!empty($log)) {
            $this->logService->logFile($log, $fileName);
        }
        return ['correct_data' => 'done'];
    }

    private function generateFileName(): string
    {
        return $this->uuidGenerator->generateUuid();
    }
}
