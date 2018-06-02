<?php

namespace  src\Serializer;

use src\Helper\ProductHelper;
use src\Helper\TruckHelper;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TableSerializer
 * @package src\Serializer
 */
class TableSerializer implements SerializeInterface
{
    /**
     * @var Table
     */
    private $table;

    /**
     * @var array
     */
    private $products;

    /**
     * TableSerializer constructor.
     * @param $products
     * @param Table $table
     */
    public function __construct(array $products, Table $table)
    {
        $this->table = $table;
        $this->products = $products;
    }

    public function serialize()
    {
        $this->setHeaders();
        $this->setBody();
        $this->table->render();
    }

    private function setHeaders()
    {
        $this->table
            ->setHeaders(
                [
                    [
                        new TableCell('Deliverable products', ['colspan' => 1])
                    ],
                    [
                        'Product',
                        'P. from',
                        'P. to',
                        'P. origin lat',
                        'P. origin lng',
                        'P. dest. lat',
                        'P. dest. lng',
                        'Truck',
                        'T. from',
                        'T. origin lat',
                        'T. origin lng',
                        'T. distance (km)'
                    ]
                ]
            );
    }

    private function setBody()
    {
        foreach ($this->products as $product) {
            $truck = $product[ProductHelper::AVAILABLE_TRUCK];
            $this->table->addRow(
                [
                    $product[ProductHelper::PRODUCT],
                    $product[ProductHelper::ORIGIN_CITY],
                    $product[ProductHelper::DESTINATION_CITY],
                    round($product[ProductHelper::ORIGIN_LAT], 3),
                    round($product[ProductHelper::ORIGIN_LNG], 3),
                    round($product[ProductHelper::DESTINATION_LAT], 3),
                    round($product[ProductHelper::DESTINATION_LNG], 3),
                    substr($truck[TruckHelper::TRUCK],0, 5),
                    $truck[TruckHelper::CITY],
                    round($truck[TruckHelper::ORIGIN_LAT], 3),
                    round($truck[TruckHelper::ORIGIN_LNG], 3),
                    $product[ProductHelper::TOTAL_DISTANCE],
                ]
            );
        };
    }
}