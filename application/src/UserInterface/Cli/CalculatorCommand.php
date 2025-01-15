<?php

declare(strict_types=1);

namespace App\UserInterface\Cli;

use App\Application\Service\Arithmetic\ArithmeticService;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * CLI Command for importing and processing CSV files.
 *
 * This class is responsible for executing a command that imports data from a specified CSV file
 * and performs an arithmetic operation (addition, subtraction, multiplication, or division) based on the action provided.
 */
#[AsCommand(
    name: 'csv:import',
    description: 'Imports and processes a CSV file with specified arithmetic operations.',
)]
final class CalculatorCommand extends Command
{
    /**
     * Constructor for CalculatorCommand.
     *
     * @param ArithmeticService $arithmeticService The service responsible for processing arithmetic operations.
     */
    public function __construct(private readonly ArithmeticService $arithmeticService)
    {
        parent::__construct();
    }

    /**
     * Configures the command, setting its name, description, and required arguments.
     *
     * This method sets up the command-line interface for the `csv:import` command,
     * defining the required `file` and `action` arguments.
     */
    protected function configure(): void
    {
        $this
            ->setName('csv:import')
            ->setDescription('This command imports csv files')
            ->addArgument('file', InputArgument::REQUIRED)
            ->addArgument('action', InputArgument::REQUIRED);
    }

    /**
     * Executes the command to import and process data from the provided CSV file.
     *
     * This method retrieves the file path and action from the input arguments, passes them to the
     * ArithmeticService for processing, and outputs the result. Errors are caught and displayed
     * to ensure user feedback.
     *
     * @param InputInterface $input The input interface for accessing command-line arguments.
     * @param OutputInterface $output The output interface for displaying the results or errors.
     *
     * @return int The command exit status: Command::SUCCESS (0) if successful, Command::FAILURE (1) otherwise.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $result = $this->arithmeticService->Process($input->getArgument('file'), $input->getArgument('action'));
            $output->writeln(json_encode($result, JSON_PRETTY_PRINT));
        } catch (Exception $exception) {
            $output->writeln($exception->getMessage());
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }
}
