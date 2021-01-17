<?php

/**
 * A class for creating MashTemperature value objects.
 * @var Temperature $temperature - the amount of heat
 * @var integer $duration - how long it will be kept at that temperature
 */

namespace Zleet\PunkAPI;

class MashTemperature
{
    private $temperature;
    private $duration;

    public function __construct(Temperature $temperature, int $duration)
    {
        $this->temperature = $temperature;
        $this->duration = $this->validateDuration($duration);
    }

    /**
     * Check that duration is an integer and it's also greater than zero
     */
    private function validateDuration($duration)
    {
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