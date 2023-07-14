<?php

namespace tests;

use Exception;
use InvalidArgumentException;
use LengthException;
use src\CrowdedCarriage;
use PHPUnit\Framework\TestCase;

final class CrowdedCarriageTest extends TestCase
{
    public function test_set_capacity(): void
    {
        $CrowdedCarriage = new CrowdedCarriage;

        $capacity = 20;

        $CrowdedCarriage->setCapacity($capacity);

        $this->assertEquals($capacity, $CrowdedCarriage->getCapacity());
    }

    public function test_set_capacity_not_accepts_values_lower_than_one(): void
    {
        $this->expectException(Exception::class);

        $CrowdedCarriage = new CrowdedCarriage;

        $capacity = 0;

        $CrowdedCarriage->setCapacity($capacity);
    }

    public function test_get_capacity(): void
    {
        $CrowdedCarriage = new CrowdedCarriage;

        $this->assertEquals(0, $CrowdedCarriage->getCapacity());
    }

    public function test_set_carriages(): void
    {
        $CrowdedCarriage = new CrowdedCarriage;

        $carriages = [0, 30, 45, 50];

        $CrowdedCarriage->setCarriages($carriages);
        
        $this->assertEqualsCanonicalizing($carriages, $CrowdedCarriage->getCarriages());
    }

    public function test_set_carriages_not_accepts_empty_arrays(): void
    {
        $this->expectException(LengthException::class);

        $CrowdedCarriage = new CrowdedCarriage;

        $carriages = [];

        $CrowdedCarriage->setCarriages($carriages);
    }

    public function test_set_carriages_only_accepts_integers_as_array_values(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $CrowdedCarriage = new CrowdedCarriage;

        $carriages = ['a'];

        $CrowdedCarriage->setCarriages($carriages);
    }

    public function test_get_carriages(): void
    {
        $CrowdedCarriage = new CrowdedCarriage;

        $this->assertEqualsCanonicalizing([], $CrowdedCarriage->getCarriages());
    }

    /**
     * Test the find a seat method
     *
     * @dataProvider carriagesDataProvider
     * @param integer $capacity
     * @param array $carriages
     * @param integer $expected
     *
     * @return void
     */
    public function test_find_a_seat(int $capacity, array $carriages, int $expected): void
    {
        $CrowdedCarriage = new CrowdedCarriage;

        $CrowdedCarriage->setCapacity($capacity)->setCarriages($carriages);

        $result = $CrowdedCarriage->findASeat();

        $this->assertEqualsCanonicalizing($expected, $result);
    }

    public static function carriagesDataProvider(): array
    {
        return [
            'capacity-20'   => [20, [3, 5, 4, 2], 3],
            'capacity-200'  => [200, [35, 23, 40, 21, 38], -1],
            'capacity-1000' => [1000, [50, 20, 80, 90, 100, 60, 30, 50, 80, 60], 0],
        ];
    }
}