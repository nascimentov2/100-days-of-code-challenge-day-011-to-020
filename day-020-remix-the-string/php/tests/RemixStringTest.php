<?php

namespace tests;

use src\RemixString;
use PHPUnit\Framework\TestCase;

final class RemixStringTest extends TestCase
{
    public function test_set_value(): void
    {
        $remixString = new RemixString;

        $value = 'abcd';

        $remixString->setValue($value);

        $this->assertEquals($value, $remixString->getValue());
    }

    public function test_get_value(): void
    {
        $remixString = new RemixString;

        $value = '';

        $this->assertEquals($value, $remixString->getValue());
    }

    public function test_set_order(): void
    {
        $remixString = new RemixString;

        $order = [1,2,4,5];

        $remixString->setOrder($order);

        $this->assertEqualsCanonicalizing($order, $remixString->getOrder());
    }

    public function test_get_order(): void
    {
        $remixString = new RemixString;

        $order = [];

        $this->assertEqualsCanonicalizing($order, $remixString->getOrder());
    }

    /**
     * Test the remix function
     *
     * @dataProvider stringsDataProvider
     * @param string $input
     * @param array $order
     * @param string $expected
     *
     * @return void
     */
    public function test_remix(string $input, array $order, string $expected): void
    {
        $remixString = new RemixString;

        $remixString->setValue($input)
                    ->setOrder($order);
        
        $result = $remixString->remix();

        $this->assertEquals($expected, $result);
    }

    public static function stringsDataProvider(): array
    {
        // input, array keys, expected output
        return [
            'test-case-1' => ['abcd', [0, 3, 1, 2], 'acdb'],
            'test-case-2' => ['PlOt', [1, 3, 0, 2], 'OPtl'],
            'test-case-3' => ['computer', [0, 2, 1, 5, 3, 6, 7, 4], 'cmourpte'],
            'test-case-4' => ['twist', [4, 0, 1, 2, 3], 'wistt'],
            'test-case-5' => ['responsibility', [0, 6, 8, 11, 10, 7, 13, 5, 3, 2, 4, 12, 1, 9], 'rtibliensyopis'],
            'test-case-6' => ['Interference', [6, 9, 10, 11, 7, 3, 0, 2, 5, 1, 8, 4], 'enrfeeIrcnte'],
            'test-case-7' => ['sequence', [5, 7, 3, 4, 0, 1, 2, 6], 'encqusee'],
        ];
    }
}