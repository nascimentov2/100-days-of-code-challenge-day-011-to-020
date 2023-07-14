<?php

namespace src;

use Exception;

class CrowdedCarriage
{
    private int $capacity = 0;

    private array $carriages = [];

    public function setCapacity(int $capacity): object
    {
        if($capacity < 1){
            throw new Exception(
                'The capacity value must be an integer higher than one.'
            );
        }

        $this->capacity = $capacity;

        return $this;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCarriages(array $carriages): object
    {
        if(count($carriages) < 1){
            throw new \LengthException(
                'The carriages must be an array that contains at least one value.'
            );
        }

        foreach($carriages as $key => $value){

            if(!is_numeric($value)){
                throw new \InvalidArgumentException(sprintf(
                    'Tha value %d on key %d is invalid. All values must be of type integer.',
                    $value, $key
                ));
            }
        }

        $this->carriages = $carriages;

        return $this;
    }

    public function getCarriages(): array
    {
        return $this->carriages;
    }

    public function findASeat(): int
    {
        $capacity  = $this->getCapacity();
        $carriages = $this->getCarriages();

        if($capacity < 1){
            throw new Exception(
                'You must first set the total capacity.'
            );
        }

        if(count($carriages) < 1){
            throw new Exception(
                'You must first set the current passengers value for at least one carriage.'
            );
        }

        $not_found = -1; //the default value to return if none of the carriages can be filled

        $capacity_by_carriage = ($capacity / count($carriages));

        foreach($carriages as $key => $passengers_in_carriage){
            
            $percent_filled = ($passengers_in_carriage / $capacity_by_carriage)*100;

            if($percent_filled <= 50){
                return $key;
            }
        }

        return $not_found;
    }
}