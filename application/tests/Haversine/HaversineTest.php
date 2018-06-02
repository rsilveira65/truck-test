<?php

namespace Haversine\Test;

use PHPUnit\Framework\TestCase;
use src\Helper\HaversineHelper;
use src\Haversine\Haversine;

class HaversineTest extends TestCase
{
    private $productMock = [
        'Oranges',
        'Fort Madison',
        'IA',
        40.6297634,
        -91.31453499999999,
        'Ottawa',
        'IL',
        41.3455892,
        -88.8425769
    ];

    private $truckMock = [
        'Wisebuys Stores Incouverneur',
        'Washington',
        'WV',
        39.244853,
        -81.6637765
    ];

    public function testCalculate()
    {
        $haversine = new Haversine();

        $result = $haversine->calculateDistances(
            $this->productMock,
            $this->truckMock, HaversineHelper::PRODUCT_ORIGIN_TO_PRODUCT_DESTINATION
        );

        $this->assertEquals(
            222,
            $result,
            'Return of calculate method  PRODUCT_ORIGIN_TO_PRODUCT_DESTINATION must be 222.'
        );

        $result = $haversine->calculateDistances(
            $this->productMock,
            $this->truckMock, HaversineHelper::TRUCK_ORIGIN_TO_PRODUCT_ORIGIN
        );

        $this->assertEquals(
            837.0,
            $result,
            'Return of calculate method TRUCK_ORIGIN_TO_PRODUCT_ORIGIN must be 837.0.'
        );

        $result = $haversine->calculateDistances(
            $this->productMock,
            $this->truckMock, HaversineHelper::TRUCK_ORIGIN_TO_PRODUCT_DESTINATION
        );

        $this->assertEquals(
            652.0,
            $result,
            'Return of calculate method TRUCK_ORIGIN_TO_PRODUCT_DESTINATION must be 652.0.'
        );
    }
}