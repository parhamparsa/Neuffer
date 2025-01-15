<?php

declare(strict_types=1);

namespace App\Tests\unit\Infrastructure\Csv;

use App\Infrastructure\Csv\CsvReader;
use PHPUnit\Framework\TestCase;

class CsvReaderTest extends TestCase
{
    public function testReadExcelFile(): void
    {
        $testFilePath = __DIR__ . '/test.csv'; // Adjust the path if necessary
        $expectedData = [
            ['97', '90'],
        ];
        $csvReader = new CsvReader();
        $actualData = $csvReader->read($testFilePath);
        $this->assertEquals($expectedData, $actualData, 'The data read from the Excel file does not match the expected data.');
    }
}
