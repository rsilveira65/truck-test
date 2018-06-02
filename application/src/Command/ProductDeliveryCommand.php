<?php
namespace src\Command;

use src\Helper\commandLineErrorHelper;
use src\Logger\ApplicationLogger;
use src\Serializer\TableSerializer;
use src\Service\CsvParseService;
use src\Processor\DeliveryProcessor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ProductDeliveryCommand
 * @package src\Command
 */
class ProductDeliveryCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('run:calculate')
            ->addOption('products', null, InputOption::VALUE_REQUIRED)
            ->addOption('trucks', null, InputOption::VALUE_REQUIRED);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $csvParseService = new CsvParseService();
            $csvParseService
                ->setCargoFilePath($this->validateParameters($input->getOption('products')))
                ->setTrucksFilePath($this->validateParameters($input->getOption('trucks')));

            $deliveryProcessor = new DeliveryProcessor($csvParseService->parse());

            $tableSerializer = new TableSerializer(
                $deliveryProcessor->calculate(),
                new Table($output)
            );

            $tableSerializer->serialize();

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
        if (empty($parameter)) {
            throw new \Exception('Please add a valid argument.', CommandLineErrorHelper::INVALID_ARGUMENT);
        }

        return $parameter;
    }
}