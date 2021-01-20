<?php

/**
 * MashTemperature.php
 *
 * A class for creating MashTemperature value objects.
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

namespace Zleet\PunkAPI;

class MashTemperature
{
    private $temperature;
    private $duration;

    /**
     * MashTemperature constructor.
     *
     * @param Temperature $temperature the amount of heat
     * @param integer     $duration    how long it will be kept at that
     *                                 temperature
     */
    public function __construct(Temperature $temperature, int $duration)
    {
        $this->temperature = $temperature;
        $this->duration = $this->validateDuration($duration);
    }

    /**
     * Check that duration is an integer and it's also greater than zero
     *
     * @param int $duration how long to maintain the mash temperature while
     *                      brewing the beer
     *
     * @return int $duration
     */
    private function validateDuration($duration)
    {
        if ($duration <= 0) {
            throw new \InvalidArgumentException(
                "Duration must be greater than zero."
            );
        }

        return $duration;
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
     * Get the duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Get the MashTemperature object as an array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            "temperature"   => $this->temperature->toArray(),
            "duration"      => $this->duration
        ];
    }
}
