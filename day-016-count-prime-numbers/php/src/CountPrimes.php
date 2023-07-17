<?php

namespace src;

use Exception;

class CountPrimes
{
    private array $range = [];

    public function setRange(array $range): void
    {
        if(count($range) !== 2){
            throw new \LengthException(
                'The array must have 2 keys, min and max value to check.'
            );
        }

        if(!is_numeric($range[0]) || !is_numeric($range[1])){
            throw new \InvalidArgumentException(
                'Both items in array must be of type integer.'
            );
        }        

        $this->range = $range;
    }

    public function getRange(): array
    {
        return $this->range;
    }

    public function countNumbers(): int
    {
        $range = $this->range;

        if(count($range) !== 2){
            throw new \LengthException(
                'You need first set the values to check.'
            );
        }

        $min = $range[0];
        $max = $range[1];

        $primes_in_range = $this->getPrimeNumbers($min, $max);

        return count($primes_in_range);
    }

    private function getPrimeNumbers(int $min, int $max): array
    {
        if($max > 1000){
            throw new \InvalidArgumentException(
                'The maximum value is 1000'
            );
        }

        $number = ($min < 2) ? 2 : $min; //first prime number to check, the minimum value is 2
        $prime_numbers = [];

        while($number <= $max){

            $is_prime = true;
            $divible_by = [];

            for($i=2; $i<=$number; $i++){
                
                if($number % $i == 0){
                    array_push($divible_by, $i);

                    if(count($divible_by) > 1){
                        $is_prime = false; break;
                    }
                }
            }

            if($is_prime === true){
                array_push($prime_numbers, $number);
            }

            $number++;
        }

        return $prime_numbers;
    }
}