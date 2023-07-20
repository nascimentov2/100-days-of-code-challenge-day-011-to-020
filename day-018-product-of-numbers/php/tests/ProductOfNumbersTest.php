<?php

namespace tests;

use src\ProductOfNumbers;
use PHPUnit\Framework\TestCase;

final class ProductOfNumbersTest extends TestCase
{
    public function test_set_numbers(): void
    {
        $productOfNumbers = new ProductOfNumbers;

        $numbers = [1,2,3];

        $productOfNumbers->setNumbers($numbers);

        $this->assertEqualsCanonicalizing($numbers, $productOfNumbers->getNumbers());
    }

    public function test_set_numbers_not_accepts_empty_arrays(): void
    {
        $this->expectException(\LengthException::class);

        $productOfNumbers = new ProductOfNumbers;

        $numbers = [];

        $productOfNumbers->setNumbers($numbers);
    }

    public function test_set_numbers_only_accepts_integer_values(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $productOfNumbers = new ProductOfNumbers;

        $numbers = ['a1', '2b'];

        $productOfNumbers->setNumbers($numbers);
    }

    public function test_get_numbers(): void
    {
        $productOfNumbers = new ProductOfNumbers;

        $this->assertEqualsCanonicalizing([], $productOfNumbers->getNumbers());
    }

    /**
     * Test get product of numbers method
     *
     * @dataProvider numbersDataProvider
     * @param array $numbers
     * @param array $expected
     *
     * @return void
     */
    public function test_get_product_of_numbers(array $numbers, array $expected): void
    {
        $productOfNumbers = new ProductOfNumbers;

        $productOfNumbers->setNumbers($numbers);

        $result = $productOfNumbers->getProductOfNumbers();

        $this->assertEqualsCanonicalizing($expected, $result);
    }

    public static function numbersDataProvider(): array
    {
        return [
            'test-case-1' => [[1, 7, 3, 4], [84, 12, 28, 21]],
            'test-case-2' => [[1, 2, 6, 5, 9], [540, 270, 90, 108, 60]],
            'test-case-3' => [[1, 2, 3, 0, 5], [0, 0, 0, 30, 0]],
        ];
    }
}