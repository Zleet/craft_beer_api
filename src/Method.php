<?php

namespace Zleet\PunkAPI;

/**
 * Method.php
 *
 * A class for creating Method value objects.
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
class Method
{
    private $mashTemperatures;
    private $fermentation;
    private $twist;

    /**
     * Method constructor.
     *
     * @param array $mashTemperatures    an array of MashTemperature objects
     * @param Fermentation $fermentation fermentation information
     * @param null|string $twist         the twist that is used while brewing
     *                                   the beer
     */
    public function __construct(
        array $mashTemperatures,
        Fermentation $fermentation,
        $twist
    ) {
        $this->mashTemperatures = $this->validateMashTemperatures($mashTemperatures);
        $this->fermentation = $fermentation;
        $this->twist = $this->validateTwist($twist);
    }

    /**
     * Check that every element in the $mashTemperatures array is a
     * MashTemperature value object.
     *
     * @param MashTemperature a mash temperature used for brewing the beer
     *
     * @return MashTemperature
     */
    private function validateMashTemperatures($mashTemperatures)
    {
        foreach ($mashTemperatures as $mashTemperature) {
            if (get_class($mashTemperature) != 'Zleet\PunkAPI\MashTemperature') {
                throw new \InvalidArgumentException(
                    "Not every element in the mashTemperatures array"
                    . " is a MashTemperature object"
                );
            }
        }

        return $mashTemperatures;
    }

    /**
     * Validate the twist.
     *
     * @param string|null $twist - The twist that goes with the beer
     *
     * @return string|null
     */
    private function validateTwist($twist)
    {
        if ((!is_string($twist)) && (!is_null($twist))) {
            throw new \InvalidArgumentException(
                "The twist parameter passed to the Method constructor"
                        . " should be either a string or null."
            );
        }

        return $twist;
    }

    /**
     * Get the mash temperatures.
     *
     * @return array MashTemperatures - the mash temperatures
     */
    public function getMashTemperatures()
    {
        return $this->mashTemperatures;
    }

    /**
     * Get the fermentation temperature.
     *
     * @return Fermentation - the fermentation temperature
     */
    public function getFermentation()
    {
        return $this->fermentation;
    }

    /**
     * Get the twist used for brewing the beer.
     *
     * @return string - the twist used to brew the beer
     */
    public function getTwist()
    {
        return $this->twist;
    }

    /**
     * Return an array representation of the Method object.
     *
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


    /**
     * Build a Method object from an array.
     *
     * @param $methodArray
     *
     * @return Method
     */
    public static function fromArray($methodArray)
    {
        // build an array of MashTemperature objects from the subarray
        $mashTemperaturesInfoArray = $methodArray["mash_temp"];
        $mashTemperatureObjects = [];
        foreach ($mashTemperaturesInfoArray as $singleMashTemperatureInfo) {
            // build a MashTemperature object from the subarray and store it
            $mashTemperatureObject = MashTemperature::fromArray(
                $singleMashTemperatureInfo
            );
            $mashTemperatureObjects[] = $mashTemperatureObject;
        }

        // build a Fermentation object from the subarray
        $temperatureInfo = $methodArray["fermentation"]["temp"];
        $fermentationObject = Fermentation::fromArray($temperatureInfo);

        // get the twist
        $twist = $methodArray["twist"];

        // build and return a Method object
        return new Method(
            $mashTemperatureObjects,
            $fermentationObject,
            $twist
        );
    }
}
