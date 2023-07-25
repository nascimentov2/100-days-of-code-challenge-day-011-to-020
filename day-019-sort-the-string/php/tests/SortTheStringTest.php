<?php

namespace tests;

use src\SortTheString;
use PHPUnit\Framework\TestCase;

final class SortTheStringTest extends TestCase
{
    public function test_set_value(): void
    {
        $sortTheString = new SortTheString;

        $value = 'abc123';

        $sortTheString->setValue($value);

        $this->assertEquals($value, $sortTheString->getValue());
    }

    public function test_set_value_only_accepts_alphanumeric_values(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $sortTheString = new SortTheString;

        $value = 'a\]{}';

        $sortTheString->setValue($value);
    }

    public function test_get_value(): void
    {
        $sortTheString = new SortTheString;

        $value = '';

        $this->assertEquals($value, $sortTheString->getValue());
    }

    /**
     * Test the sort method
     *
     * @dataProvider stringsDataProvider
     * @param string $value
     * @param string $expected
     *
     * @return void
     */
    public function test_sort(string $value, string $expected): void
    {
        $sortTheString = new SortTheString;

        $sortTheString->setValue($value);

        $result = $sortTheString->sort();

        $this->assertEquals($expected, $result);
    }

    public function test_sort_not_runs_with_empty_value(): void
    {
        $this->expectException(\LengthException::class);

        $sortTheString = new SortTheString;

        $sortTheString->sort();
    }

    public static function stringsDataProvider(): array
    {
        return [
            'test-case-1' => ['2a1EeA', 'aAeE12'],
            'test-case-2' => ['Re4r', 'erR4'],
            'test-case-3' => ['6jnM31Q', 'jMnQ136'],
            'test-case-4' => ['846ZIbo', 'bIoZ468'],
        ];
    }
}