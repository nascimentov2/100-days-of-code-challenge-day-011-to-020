<?php

namespace tests;

use src\TemperatureConverter;
use PHPUnit\Framework\TestCase;

final class TemperatureConverterTest extends TestCase
{
    public function test_set_temperature(): void
    {
        $temperatureConverter = new TemperatureConverter;

        $temperatureConverter->setTemperature(10);

        $this->assertEquals(10, $temperatureConverter->getTemperature());
    }

    public function test_get_temperature(): void
    {
        $temperatureConverter = new TemperatureConverter;

        $temperatureConverter->setTemperature(10);

        $this->assertNotEquals(11, $temperatureConverter->getTemperature());
    }

    /**
     * Test if the set method only accepts string values
     *
     * @dataProvider invalidTemperaturesDataProvider
     * @param string $value
     *
     * @return void
     */
    public function test_set_temperature_only_accepts_numbers(string $value): void
    {
        $this->expectException(\TypeError::class);

        $temperatureConverter = new TemperatureConverter;

        $temperatureConverter->setTemperature($value);
    }

    /**
     * Test the celsius to fahrenheit converter
     *
     * @dataProvider temperaturesDataProvider
     * @param array $temperatures
     *
     * @return void
     */
    public function test_celsius_to_fahrenheit(array $temperatures): void
    {
        $temperatureConverter = new TemperatureConverter;

        $temperatureConverter->setTemperature($temperatures['C']);

        $this->assertEquals($temperatures['F'], $temperatureConverter->celsiusToFahrenheit());
    }

    /**
     * Test the celsius to kelvin converter
     *
     * @dataProvider temperaturesDataProvider
     * @param array $temperatures
     *
     * @return void
     */
    public function test_celsius_to_kelvin(array $temperatures): void
    {
        $temperatureConverter = new TemperatureConverter;

        $temperatureConverter->setTemperature($temperatures['C']);

        $this->assertEquals($temperatures['K'], $temperatureConverter->celsiusToKelvin());
    }

    public static function temperaturesDataProvider(): array
    {
        return [
            '0C 32F 273.15K'         => [['C' => 0,     'F' => 32,     'K' => 273.15]],
            '100C 212F 373.15K'      => [['C' => 100,   'F' => 212,    'K' => 373.15]],
            '-10C 14F 263.15K'       => [['C' => -10,   'F' => 14,     'K' => 263.15]],
            '300.4C 572.72F 573.55K' => [['C' => 300.4, 'F' => 572.72, 'K' => 573.55]],
        ];
    }

    public static function invalidTemperaturesDataProvider(): array
    {
        return [
            '10 degrees' => ['10degrees'],
            '10C'        => ['10C'],
            'string abc' => ['abc'],
            'misc'       => ['{/<>!@'],
        ];
    }
}