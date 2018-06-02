<?php

namespace src\Logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class ApplicationLogger
 * @package src\Logger
 */
class ApplicationLogger
{
    /**
     * @var Logger
     */
    private $logger;

    /** @const array */
    const LOG_FILE_PATH = '/../../logs/application.log';

    /**
     * ApplicationLogger constructor.
     */
    public function __construct()
    {
        $this->logger = new Logger('application');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . self::LOG_FILE_PATH, Logger::DEBUG));
    }

    /**
     * @param $message
     * @param $code
     * @return bool
     */
    public function log($message, $code)
    {
        return $this->logger->addError($message, ['code' => $code]);
    }
}