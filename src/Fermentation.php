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
     * @return \Temperature
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
}
