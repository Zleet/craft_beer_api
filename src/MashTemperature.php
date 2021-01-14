<?php

/**
 * A class for creating MashTemperature value objects.
 * @var Temperature $temperature - the amount of heat
 * @var integer $duration - how long it will be kept at that temperature
 */

namespace Zleet\PunkAPI;
use http\Exception\InvalidArgumentException;

class MashTemperature
{
    private $temperature;
    private $duration;

    public function __construct(Temperature $temperature, int $duration)
    {
        $this->temperature = $this->validateTemperature($temperature);
        $this->duration = $this->validateDuration($duration);
    }

    /**
     * @param Temperature $temperature - a temperature object
     * Check that $temperature is a Temperature object
     */
    private function validateTemperature($temperature)
    {
        if (get_class($temperature) != "Zleet\PunkAPI\Temperature") throw new \InvalidArgumentException("Temperature passed to MashTemperature constructor must be a temperature object.");

        return $temperature;
    }

    /**
     * Check that duration is an integer and it's also greater than zero
     */
    private function validateDuration($duration)
    {
        if (!is_integer($duration)) throw new \InvalidArgumentException("Duration must be an integer");
        if ($duration <= 0) throw new \InvalidArgumentException("Duration must be greater than zero.");

        return $duration;
    }

    /**
     * Get the temperature
     * @return Temperature
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Get the duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Get the MashTemperature object as an array
     */
    public function toArray()
    {
        return [
            "temperature"   => $this->temperature->toArray(),
            "duration"      => $this->duration
        ];
    }

}