<?php

namespace src;

class ChangeTheWord
{
    private string $word = '';

    public function setWord(string $word): void
    {
        if(strlen($word) < 1){
            throw new \LengthException(
                'The word needs to be at least 1 character long.'
            );
        }

        if(!ctype_alpha($word)){
            throw new \InvalidArgumentException(
                'The word must only contains alpha characteres [a-zA-Z].'
            );
        }

        $this->word = $word;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function change(): string
    {
        $word = $this->getWord();

        if(strlen($word) < 1){
            throw new \LengthException(
                'The word needs to be at least 1 character long.'
            );
        }
        
        $reversed = strrev($word);
        $letters  = str_split($reversed);

        foreach($letters as $key => $letter){
            $letters[$key] = (ctype_lower($letter)) ? $letter : $this->incrementLetterByOne($letter) ;
        }

        $new_word = strtoupper(implode('', $letters));

        return $new_word;
    }

    private function incrementLetterByOne(string $letter): string
    {
        if($letter === 'Z'){
            return 'A';
        }

        return chr(ord($letter) + 1);
    }
}