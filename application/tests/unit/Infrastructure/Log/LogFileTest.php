<?php

declare(strict_types=1);

namespace App\Tests\unit\Infrastructure\Log;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class LogFileTest extends TestCase
{
    private string $testFilePath;
    private Filesystem $filesystem;

    protected function setUp(): void
    {
        parent::setUp();

        $this->filesystem = new Filesystem();
        $this->testFilePath = __DIR__ . '/test_file.txt';

        if ($this->filesystem->exists($this->testFilePath)) {
            $this->filesystem->remove($this->testFilePath);
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        if ($this->filesystem->exists($this->testFilePath)) {
            $this->filesystem->remove($this->testFilePath);
        }
    }

    public function testFileCreationAndContent(): void
    {
        $expectedContent = "Line 1\nLine 2\nLine 3";

        file_put_contents($this->testFilePath, $expectedContent);

        $this->assertFileExists($this->testFilePath, 'The test file was not created.');

        $actualContent = file_get_contents($this->testFilePath);
        $this->assertEquals($expectedContent, $actualContent, 'The contents of the test file do not match the expected data.');
    }
}
