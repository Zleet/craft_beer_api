<?php

namespace Zleet\PunkAPI;

/**
 *  Fermentation.php
 *
 * A class for creating Fermentation value objects.
 *
 * PHP version 7.3
 *
 * @category Components
 * @package  Punk_API
 * @author   Michael McLarnon <michaelmclarnon@hotmail.co.uk>
 * @license  MIT License
 * @version  GIT: @0.1
 * @link     https://www.usedcarsni.com
 */
class Fermentation
{
    private $temperature;

    /**
     * Fermentation constructor
     *
     * @param Temperature $temperature - a temperature object
     */
    public function __construct(Temperature $temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * Get the temperature
     *
     * @return Temperature
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Return the Fermentation object as an array.
     *
     * @return array - a Temperature object converted to an array
     */
    public function toArray()
    {
        return [
            "temperature" => $this->temperature->toArray()
        ];
    }

    /**
     * Build a Fermentation object from a temperature array in the format:
     * [
     *  "value" => 19,
     *  "unit"  => "celsius"
     * ]
     *
     * @param $temperatureArray
     *
     * @return Fermentation
     */
    public static function fromArray($temperatureArray)
    {
        // build a Temperature object from $temperatureArray
        $temperatureObject = Temperature::fromArray($temperatureArray);

        // use the Temperature object to build a new Fermentation object
        return new Fermentation($temperatureObject);
    }
}
