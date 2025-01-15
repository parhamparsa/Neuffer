<?php

namespace App\Tests\unit\Infrastructure\Csv;

use AllowDynamicProperties;
use App\Infrastructure\Csv\CsvWriter;
use PHPUnit\Framework\TestCase;

#[AllowDynamicProperties] class CsvWriterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->outputDir = CsvWriter::FOLDER_NAME;

        if (!is_dir($this->outputDir)) {
            mkdir($this->outputDir, 0755, true);
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        if (isset($this->generatedFilePath) && file_exists($this->generatedFilePath)) {
            unlink($this->generatedFilePath);
        }

        if (is_dir($this->outputDir) && count(scandir($this->outputDir)) <= 2) {
            rmdir($this->outputDir);
        }
    }

    public function testWriteCsvFile(): void
    {
        $csvWriter = new CsvWriter(); // Adjust class name if necessary
        $data = [
            ['Header1', 'Header2', 'Header3'],
            ['Row1Col1', 'Row1Col2', 'Row1Col3'],
            ['Row2Col1', 'Row2Col2', 'Row2Col3'],
        ];
        $fileName = 'test_file';

        $this->generatedFilePath = $csvWriter->write($data, $fileName);

        $this->assertFileExists($this->generatedFilePath, 'The generated CSV file does not exist.');

        $actualContents = file_get_contents($this->generatedFilePath);
        $expectedContents = implode("\n", [
                '"Header1","Header2","Header3"',
                '"Row1Col1","Row1Col2","Row1Col3"',
                '"Row2Col1","Row2Col2","Row2Col3"',
            ]) . "\n";

        $this->assertEquals($expectedContents, $actualContents, 'The contents of the generated CSV file do not match the expected data.');
    }
}
