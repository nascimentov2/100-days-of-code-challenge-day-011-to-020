<?php

namespace src;

class ValidHexCode
{
    private string $hex_code = '';

    public function setHexCode(string $hex_code): void
    {
        $this->hex_code = $hex_code;
    }

    public function getHexCode(): string
    {
        return $this->hex_code;
    }

    public function validate(): bool
    {
        $hex_code = $this->getHexCode();

        if(empty($hex_code)){
            throw new \Exception(
                'You need first set the value to validate.'
            );
        }

        $first_char = substr($hex_code, 0, 1);

        if($first_char !== '#'){
            throw new \Exception(
                'A valid hex code must start in #.'
            );
        }

        $alpha_num_code = substr($hex_code, 1, strlen($hex_code));

        if(strlen($alpha_num_code) !== 6){
            throw new \Exception(
                'A valid hex code must be in the format #AAAAAA.'
            );
        }

        $valid = trim(preg_replace("/[a-fA-F0-9]/", '', $alpha_num_code));
        
        return strlen($valid) > 0 ? false : true ;
    }
}