<?php

namespace Helper\Test;

use PHPUnit\Framework\TestCase;
use src\Helper\ProductHelper;

class ProductHelperTest extends TestCase
{
    public function testProductHelperConstants()
    {
        $this->assertEquals(
            9,
            ProductHelper::AVAILABLE_TRUCK,
            'const AVAILABLE_TRUCK must be 9.'
        );

        $this->assertEquals(
            5,
            ProductHelper::DESTINATION_CITY,
            'const DESTINATION_CITY must be 5.'
        );

        $this->assertEquals(
            7,
            ProductHelper::DESTINATION_LAT,
            'const DESTINATION_LAT must be 7.'
        );

        $this->assertEquals(
            8,
            ProductHelper::DESTINATION_LNG,
            'const DESTINATION_LNG must be 7.'
        );

        $this->assertEquals(
            6,
            ProductHelper::DESTINATION_STATE,
            'const DESTINATION_STATE must be 6.'
        );

        $this->assertEquals(
            9,
            ProductHelper::AVAILABLE_TRUCK,
            'const AVAILABLE_TRUCK must be 9.'
        );

        $this->assertEquals(
            1,
            ProductHelper::ORIGIN_CITY,
            'const ORIGIN_CITY must be 1.'
        );

        $this->assertEquals(
            3,
            ProductHelper::ORIGIN_LAT,
            'const ORIGIN_LAT must be 3.'
        );

        $this->assertEquals(
            4,
            ProductHelper::ORIGIN_LNG,
            'const ORIGIN_LNG must be 4.'
        );

        $this->assertEquals(
            2,
            ProductHelper::ORIGIN_STATE,
            'const ORIGIN_STATE must be 2.'
        );

        $this->assertEquals(
            0,
            ProductHelper::PRODUCT,
            'const PRODUCT must be 0.'
        );

        $this->assertEquals(
            10,
            ProductHelper::TOTAL_DISTANCE,
            'const TOTAL_DISTANCE must be 10.'
        );
    }
}