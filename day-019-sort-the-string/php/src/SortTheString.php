<?php

namespace src;

class SortTheString
{
    private string $value = '';

    public function setValue(string $value): void
    {
        if(!ctype_alnum($value)){
            throw new \InvalidArgumentException(
                'The value must contains only alphanumeric chars [a-zA-Z0-9].'
            );
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function sort(): string
    {
        $value = $this->getValue();

        if(empty($value)){
            throw new \LengthException(
                'You must first set the value to sort.'
            );
        }

        $sorted_letters = $this->sortStringByCaseOrder($value);
        
        $numbers = str_split( preg_replace("/[^0-9]+/", "", $value) );
        sort($numbers);

        $sorted_string = $sorted_letters.implode('', $numbers);

        return $sorted_string;
    }

    private function sortStringByCaseOrder(string $string): string
    {   
        $sorted = [];
        
        $lower_letters = str_split( preg_replace("/[^a-z]+/", "", $string) );
        $upper_letters = str_split( preg_replace("/[^A-Z]+/", "", $string) );

        sort($lower_letters);
        sort($upper_letters);
        
        foreach($lower_letters as $key => $lower_letter){

            array_push($sorted, $lower_letter);

            $has_next = isset($lower_letters[$key+1]) ? true : false ;

            foreach($upper_letters as $key => $upper_letter){

                if($has_next){
                    
                    if( ord($upper_letter) < ord(strtoupper($lower_letters[$key+1])) ){

                        array_push($sorted, $upper_letter);
                        unset($upper_letters[$key]);
                    }else{
                        break;
                    }
                
                }else{
                    array_push($sorted, $upper_letter);
                }
            }
        }
        
        return implode('', $sorted);
    }
}