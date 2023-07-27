<?php

namespace src;

class RemixString
{
    private string $value = '';

    private array $order = [];

    public function setValue(string $value): object
    {
        if( strlen($value) < 2 ){
            throw new \LengthException(
                'The input value must have at least 2 chars.'
            );
        }

        $this->value = $value;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setOrder(array $order): object
    {
        if( count($order) < 2 ){
            throw new \LengthException(
                'The order keys must have at least 2 items.'
            );
        }

        $input = implode('', $order);

        if( !ctype_digit($input) ){
            throw new \InvalidArgumentException(
                'All values in the order keys must be of type integer.'
            );
        }

        $this->order = $order;

        return $this;
    }

    public function getOrder(): array
    {
        return $this->order;
    }

    public function remix(): string
    {
        $value = $this->getValue();
        $order = $this->getOrder();

        if( strlen($value) < 2 || count($order) < 2 ){
            throw new \LengthException(
                'You must set the value and order before remix.'
            );
        }

        $input = str_split($value);

        if( count($input) !== count($order) ){
            throw new \LengthException(
                'The input value and the order must have the same size.'
            );
        }

        $remixed = [];

        foreach($order as $key => $value){
            $remixed[$value] = $input[$key];
        }
        
        ksort($remixed);

        $value_remixed = implode('', $remixed);

        return $value_remixed;
    }
}