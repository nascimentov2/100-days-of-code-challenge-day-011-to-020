<?php

namespace tests;

use src\DoublePalidromes;
use PHPUnit\Framework\TestCase;

final class DoublePalidromesTest extends TestCase
{
    public function test_set_values(): void
    {
        $doublePalindromes = new DoublePalidromes;

        $doublePalindromes->setValues(['abc', '123', 'abc']);

        $this->assertEqualsCanonicalizing(['abc', '123', 'abc'], $doublePalindromes->getValues());
    }

    public function test_get_values(): void
    {
        $doublePalindromes = new DoublePalidromes;

        $this->assertEqualsCanonicalizing([], $doublePalindromes->getValues());
    }

    public function test_set_values_not_accepts_empty_array(): void
    {
        $this->expectException(\LengthException::class);

        $doublePalindromes = new DoublePalidromes;
        
        $doublePalindromes->setValues([]);
    }

    /**
     * Test the check values for double palidromes method
     *
     * @dataProvider valuesDataProvider
     * @param array $value
     * @param array $expected
     *
     * @return void
     */
    public function test_check_values_for_double_palidromes(array $values, array $expected): void
    {
        $doublePalindromes = new DoublePalidromes;

        $doublePalindromes->setValues($values);

        $this->assertEqualsCanonicalizing($expected, $doublePalindromes->checkValuesForDoublePalidromes());
    }

    public static function valuesDataProvider(): array
    {
        return [
            'dataset-1' => [["cb77c", "ccc888", "ccc789", "abc89"], [2, 2, 1, 0]],
            'dataset-2' => [["789", "555", "ccc", "abba"], [0, 1, 1, 1]],
            'dataset-3' => [["7a", "5f", "6c"], [2, 2, 2]],
        ];
    }
}