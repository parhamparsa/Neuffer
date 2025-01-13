<?php

declare(strict_types=1);

namespace App\UserInterface\Cli;

use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'csv:import',
    description: 'c',
)]
final class CalculatorCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('csv:import')
            ->setDescription('This command imports csv files')
            ->addArgument('file', InputArgument::OPTIONAL);
    }

    /**
     * Executes the command to import NPS records from the provided CSV file.
     *
     * The command fetches the file path from the input argument, passes it to the service,
     * and processes the data. If there is an error, it is caught and displayed in the output.
     *
     * @param InputInterface $input The input interface for accessing command-line arguments.
     * @param OutputInterface $output The output interface for displaying the result.
     *
     * @return int The command exit status: Command::SUCCESS or Command::FAILURE.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {

        } catch (Exception $exception) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
