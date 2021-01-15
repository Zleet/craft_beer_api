<?php

/**
 * A class for creating Method value objects.
 * A Method value object consists of:
 * @var MashTemperature $mashTemperature - the mash temperature
 * @var Fermentation $fermentation - the fermentation temperature
 */

namespace Zleet\PunkAPI;
use http\Exception\InvalidArgumentException;

class Method
{
    private $mashTemperature;
    private $fermentation;
    private $twist;

    public function __construct(
        MashTemperature $mashTemperature,
        Fermentation $fermentation,
        string $twist
    ) {
        $this->mashTemperature = $mashTemperature;
        $this->fermentation = $fermentation;
        $this->twist = $this->validateTwist($twist);
    }

    /**
     * @param string $twist - The twist that goes with the beer
     * @return string
     */
    private function validateTwist($twist)
    {
        if (!is_string($twist)) {
            throw new InvalidArgumentException("The twist parameter passed to the Method constructor should be a string.");}

        return $twist;
    }

    /**
     * @return MashTemperature - the mash temperature
     */
    public function getMashTemperature()
    {
        return $this->mashTemperature;
    }

    /**
     * @return Fermentation - the fermentation temperature
     */
    public function getFermentation()
    {
        return $this->fermentation;
    }
    // get twist

    /**
     * @return string - the twist that goes with the beer
     */
    public function getTwist()
    {
        return $this->twist;
    }

    /**
     * @return array - an array representation of the Method object
     */
    public function toArray()
    {
        return [
            "mash_temperature"  => $this->mashTemperature->toArray(),
            "fermentation"      => $this->fermentation->toArray(),
            "twist"             => $this->twist
        ];
    }

}
