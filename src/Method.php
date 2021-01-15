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

    // twist can be null or a string
    private function validateTwist($twist)
    {
        if (!is_string($twist)) {
            throw new InvalidArgumentException("The twist parameter passed to the Method constructor should be a string.");}

        return $twist;
    }

    // get mashTemperature
    public function getMashTemperature()
    {
        return $this->mashTemperature;
    }

    // get fermentation
    public function getFermentation()
    {
        return $this->fermentation;
    }
    // get twist
    public function getTwist()
    {
        return $this->twist;
    }

    // return the Method object as an array
    public function toArray()
    {
        return [
            "mash_temperature"  => $this->mashTemperature->toArray(),
            "fermentation"      => $this->fermentation->toArray(),
            "twist"             => $this->twist
        ];
    }

}
