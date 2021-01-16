<?php

/**
 * A class for creating Method value objects.
 * A Method value object consists of:
 * @var array $mashTemperatures - an array of MashTemperature objects
 * @var Fermentation $fermentation - the fermentation temperature
 */

namespace Zleet\PunkAPI;
use http\Exception\InvalidArgumentException;

class Method
{
    private $mashTemperatures;
    private $fermentation;
    private $twist;

    public function __construct(
        array $mashTemperatures,
        Fermentation $fermentation,
        string $twist
    ) {
        $this->mashTemperatures = $this->validateMashTemperatures(
            $mashTemperatures);
        $this->fermentation = $fermentation;
        $this->twist = $this->validateTwist($twist);
    }

    /**
     * Check that every element in the $mashTemperatures array is a
     * MashTemperature value object
     */
    private function validateMashTemperatures($mashTemperatures)
    {
        foreach($mashTemperatures as $mashTemperature) {
            if (get_class($mashTemperature) != 'Zleet\PunkAPI\MashTemperature') {
                throw new \InvalidArgumentException("Not every element in the mashTemperatures array is a MashTemperature object");
            }
        }

        return $mashTemperatures;
    }

    /**
     * @param string $twist - The twist that goes with the beer
     * @return string
     */
    private function validateTwist($twist)
    {
        if (!is_string($twist)) {
            throw new \InvalidArgumentException("The twist parameter passed to the Method constructor should be a string.");}

        return $twist;
    }

    /**
     * @return array MashTemperatures - an array of mash temperatures
     */
    public function getMashTemperatures()
    {
        return $this->mashTemperatures;
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
        // build an array containing all the MashTemperature objects in
        // $this->mashTemperatures;
        $arrayOfMashTemperatureArrays = [];
        foreach ($this->mashTemperatures as $mashTemperature) {
            $mashTemperatureAsArray = $mashTemperature->toArray();
            $arrayOfMashTemperatureArrays[] = $mashTemperatureAsArray;
        }

        return [
            "mash_temperature"  => $arrayOfMashTemperatureArrays,
            "fermentation"      => $this->fermentation->toArray(),
            "twist"             => $this->twist
        ];
    }

}
