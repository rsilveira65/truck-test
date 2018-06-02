<?php

namespace src\Haversine;

use src\Helper\CommandLineErrorHelper;
use src\Helper\HaversineHelper;
use src\Helper\ProductHelper;
use src\Helper\TruckHelper;

/**
 * The haversine formula determines the great-circle distance between two points on a sphere given their longitudes and latitudes.
 * Important in navigation, it is a special case of a more general formula in spherical trigonometry,
 * the law of haversines, that relates the sides and angles of spherical triangles.
 * https://en.wikipedia.org/wiki/Haversine_formula
 * Class Haversine
 * @package src\Haversine
 */
class Haversine
{
    /**
     * @const int
     */
    const EARTH_RADIUS = 6371;

    /**
     * @param array $product
     * @param array $truck
     * @param int $type
     * @return float
     * @throws \Exception
     */
    public function calculateDistances(
        array $product,
        array $truck,
        $type = HaversineHelper::PRODUCT_ORIGIN_TO_PRODUCT_DESTINATION
    )
    {
        if ($type == HaversineHelper::TRUCK_ORIGIN_TO_PRODUCT_ORIGIN) {
            return $this->calculate(
                $truck[TruckHelper::ORIGIN_LAT],
                $truck[TruckHelper::ORIGIN_LNG],
                $product[ProductHelper::ORIGIN_LAT],
                $product[ProductHelper::ORIGIN_LNG]
            );
        }

        if ($type == HaversineHelper::TRUCK_ORIGIN_TO_PRODUCT_DESTINATION) {
            return $this->calculate(
                $truck[TruckHelper::ORIGIN_LAT],
                $truck[TruckHelper::ORIGIN_LNG],
                $product[ProductHelper::DESTINATION_LAT],
                $product[ProductHelper::DESTINATION_LNG]
            );
        }

        if ($type == HaversineHelper::PRODUCT_ORIGIN_TO_PRODUCT_DESTINATION) {
            return $this->calculate(
                $product[ProductHelper::ORIGIN_LAT],
                $product[ProductHelper::ORIGIN_LNG],
                $product[ProductHelper::DESTINATION_LAT],
                $product[ProductHelper::DESTINATION_LNG]
            );
        }

        throw new \Exception('Wrong type argument.', CommandLineErrorHelper::INVALID_ARGUMENT);
    }

    /**
     * @param $fromLat
     * @param $fromLon
     * @param $toLat
     * @param $toLon
     * @return float
     */
    private function calculate($fromLat, $fromLon, $toLat, $toLon)
    {
        $dLat = deg2rad($toLat - $fromLat);
        $dLon = deg2rad($toLon - $fromLon);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($fromLat)) * cos(deg2rad($toLat)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        $d = self::EARTH_RADIUS * $c;

        return round($d);
    }
}