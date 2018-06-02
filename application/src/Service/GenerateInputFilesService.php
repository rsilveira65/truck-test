<?php

namespace src\Service;

use Faker\Factory;
use Faker\Provider\en_US\Address;
use Keboola\Csv\CsvFile;

/**
 * Class GenerateInputFilesService
 * @package src\Service
 */
class GenerateInputFilesService
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var CsvFile
     */
    private $csvFile;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string
     */
    private $type;

    /**
     * @const string
     */
    const INPUT_PATH = '/../../inputs/%s_%s.csv';

    /**
     * @const array
     */
    const TYPE_TO_ROWS = [
        'products' =>
            [
                'product',
                'origin_city',
                'origin_state',
                'origin_lat',
                'origin_lng',
                'destination_city',
                'destination_state',
                'destination_lat',
                'destination_lng'
            ],
        'trucks' =>
            [
                'truck',
                'city',
                'state',
                'lat',
                'lng'
            ]
        ];

    /**
     * generateInputFilesService constructor.
     * @param $type
     * @param integer $quantity
     */
    public function __construct($type, $quantity = 100)
    {
        $this->faker = Factory::create();
        $this->faker->addProvider(new Address($this->faker));
        $this->quantity = $quantity;
        $this->type = $type;

        $this->csvFile = new CsvFile(
            sprintf(__DIR__ . self::INPUT_PATH, $this->type, $this->quantity),
            CsvFile::DEFAULT_DELIMITER,
            ''
        );
    }
    
    /**
     * Generate the output .csv file according with input type.
     * @throws \Keboola\Csv\Exception
     */
    public function generate()
    {
        for ($i = 1; $i <= $this->quantity; $i++) {
            //Add .csv file headers.
            if ($i == 1) {
                $this->csvFile->writeRow(
                    self::TYPE_TO_ROWS[$this->type]
                );

                continue;
            }

            $this->csvFile->writeRow(

                $this->type == 'products' ?
                [
                    $this->faker->realText(10),
                    $this->faker->city,
                    $this->faker->stateAbbr,
                    $this->faker->latitude,
                    $this->faker->longitude,
                    $this->faker->city,
                    $this->faker->stateAbbr,
                    $this->faker->latitude,
                    $this->faker->longitude
                ] :
                [
                    $this->faker->company,
                    $this->faker->city,
                    $this->faker->stateAbbr,
                    $this->faker->latitude,
                    $this->faker->longitude
                ]
            );
        }
    }
}