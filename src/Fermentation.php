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
        $this->temperature = $this->validateTemperature($temperature);
    }

    /**
     * @param Temperature $temperature
     * @return Temperature
     */
    private function validateTemperature(Temperature $temperature)
    {
        // check that $temperature is an instance of Temperature
        if (!($temperature instanceof Temperature)) throw new \InvalidArgumentException("Parameter passed to Fermentation constructor must be a Temperature object");

        return $temperature;
    }

    // get temperature

    /**
     * @return Temperature
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    // return Fermentation object as array

    /**
     * @return array - a Temperature object converted to an array
     */
    public function toArray()
    {
        return [
            "temperature" => $this->temperature->toArray()
        ];
    }

}