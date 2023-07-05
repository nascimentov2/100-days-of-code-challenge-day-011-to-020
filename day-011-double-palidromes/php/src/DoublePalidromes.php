<?php

namespace src;

class DoublePalidromes
{
    private array $values = [];

    private array $caption = [0 => 'no-palindrome', 1 => 'single-palindrome', 2 => 'double-palindrome'];

    public function setValues(array $values): void
    {
        if(count($values) < 1){
            throw new \LengthException(
                'You need to set at least one value to be checked.'
            );
        }

        $this->values = $values;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function checkValuesForDoublePalidromes(): array
    {
        $values_to_check = $this->getValues();

        if(count($values_to_check) < 1){
            throw new \LengthException(
                'You need first set the values to be checked. You can do this by calling the method setValues.'
            );
        }

        $checked_palindromes = [];

        foreach($values_to_check as $value){

            $palindrome = 0;

            $numbers_in_value = strtolower(trim(preg_replace("/[^0-9]/", '', $value)));
            $strings_in_value = strtolower(trim(preg_replace("/[^A-Za-z]/", '', $value)));
            
            $palindrome += ($numbers_in_value === strrev($numbers_in_value) && strlen($numbers_in_value) > 0) ? 1 : 0 ;
            $palindrome += ($strings_in_value === strrev($strings_in_value) && strlen($strings_in_value) > 0) ? 1 : 0 ;

            array_push($checked_palindromes, $palindrome);
        }

        return $checked_palindromes;
    }
}