<?php

namespace src;

class TemperatureConverter
{
    private float $temperature;

    public function setTemperature(float $temperature): void
    {
        if(!is_numeric($temperature)){
            throw new \InvalidArgumentException(
                'The value must be only numeric (- "minus" is allowed)'
            );
        }

        $this->temperature = $temperature;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function celsiusToFahrenheit(): float
    {
        $value_in_celsius = $this->getTemperature();

        $value_in_fahrenheit = ($value_in_celsius*9/5) + 32;

        return round($value_in_fahrenheit, 2);
    }

    public function celsiusToKelvin(): float
    {
        $value_in_celsius = $this->getTemperature();

        $value_in_kelvin = $value_in_celsius + 273.15;

        return $value_in_kelvin;
    }
}