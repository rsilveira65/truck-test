<?php

namespace src\Processor;

use src\Haversine\Haversine;
use src\Helper\HaversineHelper;
use src\Helper\ProductHelper;
use src\Helper\TruckHelper;

/**
 * Class DeliveryProcessor
 * @package src\Processor
 */
class DeliveryProcessor
{
    /**
     * @var array
     */
    private $csvParsed;

    /**
     * @var Haversine
     */
    private $haversine;

    /**
     * DeliveryProcessService constructor.
     * @param array $csvParsed
     */
    public function __construct(array $csvParsed)
    {
        $this->csvParsed = $csvParsed;
        $this->haversine = new Haversine();
    }

    /**
     * @return array
     */
    public function calculate()
    {
        $this->processProductDelivery();

        return $this->csvParsed['products'];
    }

    /**
     * Iterates each product (cargo) processing the best truck fit.
     */
    private function processProductDelivery()
    {
        foreach ($this->csvParsed['products'] as $productIndex => $product) {
            $overallCalculatedDistances = $this->processTruckDelivery($product);

            //find the shorter distance.
            $shorterDistance = min($overallCalculatedDistances);
            //get the related truck array list index.
            $truckIndex = array_keys($overallCalculatedDistances, min($overallCalculatedDistances))[0];

            $this->csvParsed['products'][$productIndex][ProductHelper::AVAILABLE_TRUCK] = $this->csvParsed['trucks'][$truckIndex];
            $this->csvParsed['products'][$productIndex][ProductHelper::TOTAL_DISTANCE] = $shorterDistance;

            //remove truck from array list to avoid be selected afterwards.
            unset($this->csvParsed['trucks'][$truckIndex]);
        }
    }

    /**
     * Delivery distance per truck:
     *
     * TRUCK-FROM - PRODUCT-FROM
     * PRODUCT-FROM - PRODUCT-TO
     * PRODUCT-TO - TRUCK-FROM
     *
     * @param array $product
     * @return array
     */
    private function processTruckDelivery(array $product)
    {
        $overallCalculatedDistances = [];
        foreach ($this->csvParsed['trucks'] as $truckIndex => $truck) {
            if (!$truck[TruckHelper::ORIGIN_LAT] or !$truck[TruckHelper::ORIGIN_LNG]) continue;

            $truckOriginToProductOriginDistance = $this->haversine->calculateDistances(
                $product,
                $truck,
                HaversineHelper::TRUCK_ORIGIN_TO_PRODUCT_ORIGIN
            );

            $productOriginToDestinationDistance = $this->haversine->calculateDistances(
                $product,
                $truck,
                HaversineHelper::PRODUCT_ORIGIN_TO_PRODUCT_DESTINATION
            );

            $truckOriginToProductDestinationDistance = $this->haversine->calculateDistances(
                $product,
                $truck,
                HaversineHelper::TRUCK_ORIGIN_TO_PRODUCT_DESTINATION
            );

            $overallCalculatedDistances[$truckIndex] =
                $truckOriginToProductOriginDistance +
                $productOriginToDestinationDistance +
                $truckOriginToProductDestinationDistance;
        }

        return $overallCalculatedDistances;
    }
}