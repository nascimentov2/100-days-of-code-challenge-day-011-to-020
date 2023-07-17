<?php

namespace tests;

use src\CountPrimes;
use PHPUnit\Framework\TestCase;

final class CountPrimesTest extends TestCase
{
    public function test_set_range(): void
    {
        $countPrimes = new CountPrimes;

        $range = [1, 50];

        $countPrimes->setRange($range);

        $this->assertEqualsCanonicalizing($range, $countPrimes->getRange());
    }

    public function test_set_range_only_accepts_valid_arrays(): void
    {
        $this->expectException(\LengthException::class);

        $countPrimes = new CountPrimes;

        $range = [1, 50, 30];

        $countPrimes->setRange($range);
    }

    public function test_set_range_only_accepts_int_values(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $countPrimes = new CountPrimes;

        $range = ['1a', '2b'];

        $countPrimes->setRange($range);
    }

    public function test_get_range(): void
    {
        $countPrimes = new CountPrimes;

        $this->assertEqualsCanonicalizing([], $countPrimes->getRange());
    }

    /**
     * Test the count prime numbers in range
     *
     * @dataProvider numbersDataProvider
     * @param array $range
     * @param integer $expected
     *
     * @return void
     */
    public function test_count_numbers(array $range, int $expected): void
    {
        $countPrimes = new CountPrimes;

        $countPrimes->setRange($range);

        $result = $countPrimes->countNumbers();

        $this->assertEquals($expected, $result);
    }

    public static function numbersDataProvider(): array
    {
        return [
            'range-1-10'   => [[1,10], 4],
            'range-1-100'  => [[1,100], 25],
            'range-1-1000' => [[1,1000], 168],
        ];
    }
}