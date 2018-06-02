<?php

namespace Helper\Test;

use PHPUnit\Framework\TestCase;
use src\Helper\HaversineHelper;

class HaversineHelperTest extends TestCase
{
    public function testHaversineHelperConstants()
    {
        $this->assertEquals(
            2,
            HaversineHelper::PRODUCT_ORIGIN_TO_PRODUCT_DESTINATION,
            'const PRODUCT_ORIGIN_TO_PRODUCT_DESTINATION must be 2.'
        );

        $this->assertEquals(
            1,
            HaversineHelper::TRUCK_ORIGIN_TO_PRODUCT_DESTINATION,
            'const TRUCK_ORIGIN_TO_PRODUCT_DESTINATION must be 1.'
        );

        $this->assertEquals(
            0,
            HaversineHelper::TRUCK_ORIGIN_TO_PRODUCT_ORIGIN,
            'const TRUCK_ORIGIN_TO_PRODUCT_ORIGIN must be 0.'
        );
    }
}