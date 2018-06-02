<?php
namespace src\Command;

use src\Helper\commandLineErrorHelper;
use src\Logger\ApplicationLogger;
use src\Service\GenerateInputFilesService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenerateTestInputsCommand
 * @package src\Command
 */
class GenerateTestInputsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('run:generate')
            ->addOption('type', null, InputOption::VALUE_REQUIRED)
            ->addOption('quantity', null, InputOption::VALUE_REQUIRED, '', 100);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $generateInputFiles = new GenerateInputFilesService(
                $this->validateParameters($input->getOption('type')),
                $input->getOption('quantity')
            );

            $generateInputFiles->generate();

        } catch (\Exception $e) {
            $logger = new ApplicationLogger();

            $logger->log($e->getMessage(), $e->getCode());
            $output->writeln($e->getMessage());
        }
    }

    /**
     * @param $parameter
     * @return mixed
     * @throws \Exception
     */
    protected function validateParameters($parameter)
    {
        $availableTypes = ['products', 'trucks'];

        if (empty($parameter) or !in_array($parameter, $availableTypes)) {
            throw new \Exception('Please add a valid argument.', CommandLineErrorHelper::INVALID_ARGUMENT);
        }

        return $parameter;
    }
}