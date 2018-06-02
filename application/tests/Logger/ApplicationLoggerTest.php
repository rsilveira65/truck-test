<?php

namespace Logger\Test;

use PHPUnit\Framework\TestCase;
use src\Logger\ApplicationLogger;

class ApplicationLoggerTest extends TestCase
{
    public function testLog()
    {
        $logService = new ApplicationLogger();

        $result = $logService->log('test from phpunit.', 500);

        $this->assertTrue(
            $result,
            'Return of log method must true.'
        );
    }
}