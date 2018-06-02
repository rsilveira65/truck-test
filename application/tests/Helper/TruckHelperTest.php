<?php

namespace Helper\Test;

use PHPUnit\Framework\TestCase;
use src\Helper\TruckHelper;

class TruckHelperTest extends TestCase
{
    public function testTruckHelperConstants()
    {
        $this->assertEquals(
            4,
            TruckHelper::ORIGIN_LNG,
            'const ORIGIN_LNG must be 4.'
        );

        $this->assertEquals(
            3,
            TruckHelper::ORIGIN_LAT,
            'const ORIGIN_LAT must be 3.'
        );

        $this->assertEquals(
            1,
            TruckHelper::CITY,
            'const CITY must be 1.'
        );

        $this->assertEquals(
            2,
            TruckHelper::STATE,
            'const STATE must be 2.'
        );

        $this->assertEquals(
            0,
            TruckHelper::TRUCK,
            'const TRUCK must be 0.'
        );
    }
}