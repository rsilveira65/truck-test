<?php

namespace Service\Test;

use PHPUnit\Framework\TestCase;
use src\Service\CsvParseService;

class CsvParseServiceTest extends TestCase
{
    public function testSetCargoFilePathIsNotNull()
    {
        $csvParseService = new CsvParseService();

        $this->assertNotNull(
            $csvParseService->setCargoFilePath('inputs/cargo.csv'),
            'Return of setCargoFilePath can not be null.'
        );
    }

    public function testSetTruckFilePathIsNotNull()
    {
        $csvParseService = new CsvParseService();

        $this->assertNotNull(
            $csvParseService->setTrucksFilePath('inputs/trucks.csv'),
            'Return of setTrucksFilePath can not be null.'
        );
    }

    public function testParse()
    {
        $csvParseService = new CsvParseService();
        $csvParseService
            ->setCargoFilePath('inputs/cargo.csv')
            ->setTrucksFilePath('inputs/trucks.csv');

        $this->assertNotNull(
            $csvParseService->parse(),
            'Return of parse can not be null.'
        );

        $this->assertArrayHasKey(
            'products',
            $csvParseService->parse(),
            "Return of parse must be an array and has 'products' key"
        );

        $this->assertArrayHasKey(
            'trucks',
            $csvParseService->parse(),
            "Return of parse must be an array and has 'trucks' key"
        );

    }
}