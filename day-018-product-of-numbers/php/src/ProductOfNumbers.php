<?php

namespace src;

class ProductOfNumbers
{
    private array $numbers = [];

    public function setNumbers(array $numbers): void
    {
        if(count($numbers) < 1){
            throw new \LengthException(
                'The array must have at least one value.'
            );
        }

        foreach($numbers as $number){
            if(!is_numeric($number)){
                throw new \InvalidArgumentException(
                    'All keys in array must be of type integer.'
                );
            }
        }

        $this->numbers = $numbers;
    }

    public function getNumbers(): array
    {
        return $this->numbers;
    }

    public function getProductOfNumbers(): array
    {
        $numbers = $this->getNumbers();

        if(count($numbers) < 1){
            throw new \LengthException(
                'You must first set the numbers to check.'
            );
        }

        $product_of_numbers = [];

        foreach($numbers as $key => $number){
            
            $math_array = $this->removeKeyAndReturnArray($numbers, $key);

            $product = array_product($math_array);

            array_push($product_of_numbers, $product);
        
        }

        return $product_of_numbers;
    }

    private function removeKeyAndReturnArray(array $array, mixed $key): array
    {
        if( isset($array[$key]) ){
            unset($array[$key]);
        }

        return $array;
    }
}