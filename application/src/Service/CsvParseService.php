<?php

namespace src\Service;

/**
 * Class CsvParseService
 * @package src\Service
 */
class CsvParseService
{
    /**
     * @var string
     */
    private $cargoFilePath;

    /**
     * @var string
     */
    private $trucksFilePath;

    /**
     * @param $cargoFilePath
     * @return $this
     */
    public function setCargoFilePath($cargoFilePath)
    {
        $this->cargoFilePath = $cargoFilePath;
        return $this;
    }

    /**
     * @param $trucksFilePath
     * @return $this
     */
    public function setTrucksFilePath($trucksFilePath)
    {
        $this->trucksFilePath = $trucksFilePath;
        return $this;
    }

    /**
     * @return array
     */
    public function parse()
    {
        return [
            'products' => $this->parseFromFiles($this->cargoFilePath),
            'trucks'   => $this->parseFromFiles($this->trucksFilePath)
        ];
    }

    /**
     * @param $parseStreamFile
     * @return array
     */
    private function parseFromFiles($parseStreamFile)
    {
        $parser = new \KzykHys\CsvParser\CsvParser(
            new \SplFileObject($parseStreamFile), 
            ['offset' => 1]
        );

        return $parser->parse();
    }
}