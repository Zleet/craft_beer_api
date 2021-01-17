<?php

/**
 * A class for creating Fermentation objects
 * @var Temperature $temperature - the fermentation temperature
 */
namespace Zleet\PunkAPI;

class Fermentation
{
    private $temperature;

    /**
     * Fermentation constructor
     * @param Temperature $temperature - a temperature object
     */
    public function __construct(Temperature $temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return Temperature
     * get the temperature
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @return array - a Temperature object converted to an array
     * return the Fermentation object as an array
     */
    public function toArray()
    {
        return [
            "temperature" => $this->temperature->toArray()
        ];
    }

}