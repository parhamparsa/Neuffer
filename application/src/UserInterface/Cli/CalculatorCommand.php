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

#[AsCommand(
    name: 'csv:import',
    description: 'c',
)]
final class CalculatorCommand extends Command
{
    public function __construct(private readonly ArithmeticService $arithmeticService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('csv:import')
            ->setDescription('This command imports csv files')
            ->addArgument('file', InputArgument::REQUIRED)
            ->addArgument('action', InputArgument::REQUIRED);
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
            $result = $this->arithmeticService->Process($input->getArgument('file'), $input->getArgument('action'));
            $output->writeln(json_encode($result, JSON_PRETTY_PRINT));
        } catch (Exception $exception) {
            $output->writeln($exception->getMessage());
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }
}
