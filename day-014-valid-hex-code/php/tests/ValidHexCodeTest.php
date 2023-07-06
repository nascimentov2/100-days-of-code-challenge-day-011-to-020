<?php

namespace tests;

use Exception;
use src\ValidHexCode;
use PHPUnit\Framework\TestCase;

final class ValidHexCodeTest extends TestCase
{
    public function test_set_hex_code(): void
    {
        $validHexCode = new ValidHexCode;

        $validHexCode->setHexCode('#CD5C5C');

        $this->assertEquals('#CD5C5C', $validHexCode->getHexCode());
    }

    public function test_get_hex_code(): void
    {
        $validHexCode = new ValidHexCode;

        $this->assertEquals('', $validHexCode->getHexCode());
    }

    /**
     * Test default validation
     *
     * @dataProvider hexCodesDataProvider
     * @param string $hex_code
     * @param boolean $expected
     *
     * @return void
     */
    public function test_validate(string $hex_code, bool $expected): void
    {
        $validHexCode = new ValidHexCode;

        $validHexCode->setHexCode($hex_code);

        $this->assertEquals($expected, $validHexCode->validate());
    }

    /**
     * Test validations in the validate method
     *
     * @dataProvider invalidHexCodesDataProvider
     * @param string $hex_code
     *
     * @return void
     */
    public function test_validate_not_accepts_invalid_formats(string $hex_code): void
    {
        $this->expectException(Exception::class);

        $validHexCode = new ValidHexCode;

        $validHexCode->setHexCode($hex_code);

        $validHexCode->validate();
    }

    public static function hexCodesDataProvider(): array
    {
        return [
            '#CD5C5C'  => ['#CD5C5C', true],
            '#EAECEE'  => ['#EAECEE', true],
            '#eaecee'  => ['#eaecee', true],
            '#CD5C5Z'  => ['#CD5C5Z', false],
            '#CD5C&C'  => ['#CD5C&C', false],
        ];
    }

    public static function invalidHexCodesDataProvider(): array
    {
        return [
            '#CD5C58C' => ['#CD5C58C'],
            'CD5C5C'   => ['CD5C5C'],
        ];
    }
}