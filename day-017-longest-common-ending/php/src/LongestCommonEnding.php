<?php

namespace src;

class LongestCommonEnding
{
    private array $words = [];

    public function setWords(array $words): void
    {
        if(count($words) !== 2){
            throw new \LengthException(
                'The array must have exactly 2 words.'
            );
        }

        if(!ctype_alpha($words[0]) || !ctype_alpha($words[0])){
            throw new \InvalidArgumentException(
                'Only alpha characteres [A-Aa-z] are accepted.'
            );
        }

        $this->words = $words;
    }

    public function getWords(): array
    {
        return $this->words;
    }

    public function getLongestCommonEnding(): string
    {
        $words = $this->getWords();

        if(count($words) !== 2){
            throw new \LengthException(
                'You must first set the words to check.'
            );
        }

        $word_1 = strrev($words[0]);
        $word_2 = strrev($words[1]);

        $chars_word_1 = str_split($word_1);
        $chars_word_2 = str_split($word_2);

        $common_ending = [];

        foreach($chars_word_1 as $key => $char){

            if(array_key_exists($key, $chars_word_2)){

                if($chars_word_2[$key] === $chars_word_1[$key]){
                    array_push($common_ending, $char);
                }else{
                    break;
                }

            }

        }

        $chars_common_ending = strrev( implode('', $common_ending) );

        return $chars_common_ending;
    }
}