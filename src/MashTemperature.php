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
     * @param Temperature  $temperature the amount of heat
     * @param integer|null $duration    how long it will be kept at that
     *                                  temperature
     */
    public function __construct(Temperature $temperature, $duration)
    {
        $this->temperature = $temperature;
        $this->duration = $this->validateDuration($duration);
    }

    /**
     * Check that duration is either null or an integer.
     * If duration is an integer, check that it's zero or greater.
     *
     * @param int|null $duration how long to maintain the mash temperature while
     *                           brewing the beer
     *
     * @return int|null
     */
    private function validateDuration($duration)
    {
        if ((!is_null($duration)) && (!is_integer($duration))) {
            throw new \InvalidArgumentException(
                "Duration must be either an integer or null."
            );
        }

        if ((is_integer($duration)) && ($duration < 0)) {
            throw new \InvalidArgumentException(
                "Duration must be zero or greater."
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
     * @return int|null
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

    /**
     * Build a new MashTemperature object from an array in the format:
     * [
     *    "temp" => [
     *         "value" => 64,
     *         "unit"  => "celsius"
     *    ],
     *    "duration" => 75
     * ]
     *
     * @param $mashTemperatureInfo
     *
     * @return MashTemperature
     */
    public static function fromArray($mashTemperatureInfo)
    {
        // build a Temperature object from the subarray
        $temperatureInfo = $mashTemperatureInfo["temp"];
        $temperatureObject = Temperature::fromArray($temperatureInfo);

        // build and return a new MashTemperature object
        return new MashTemperature(
            $temperatureObject,
            $mashTemperatureInfo["duration"]
        );
    }
}
