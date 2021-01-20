<?php

namespace Zleet\PunkAPI;

/**
 *  FermentationTest.php
 *
 * A class for testing Fermentation value objects.
 *
 * PHP version 7.3
 *
 * @category Tests
 * @package  Punk_API
 * @author   Michael McLarnon <michaelmclarnon@hotmail.co.uk>
 * @license  MIT License
 * @version  GIT: @0.1
 * @link     https://www.usedcarsni.com
 */
class FermentationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test creating a class
     */
    public function testClassCreation()
    {
        $temperature = new Temperature('39', 'fahrenheit');
        $fermentation = new Fermentation($temperature);

        $this->assertInstanceOf(Fermentation::class, $fermentation);
    }

    // test getting Temperature

    /**
     * Test getting the Temperature object from a FermentationTest object
     */
    public function testGettingTemperature()
    {
        $temperature = new Temperature('39', 'fahrenheit');
        $fermentation = new Fermentation($temperature);

        $this->assertInstanceOf(
            Temperature::class,
            $fermentation->getTemperature(),
            'Fermentation->getTemperature does not return a"
            . " Temperature object.'
        );
    }

    /**
     * Test getting Fermentation object as array
     */
    public function testGettingFermentationObjectAsArray()
    {
        $temperature = new Temperature('39', 'fahrenheit');
        $fermentation = new Fermentation($temperature);

        $this->assertIsArray($fermentation->toArray(), "fermentation->toArray() does not return an array.");
    }

    /**
     * Test creating a Fermentation object from a temperature array
     */
    public function testBuildingAFermentationFromATemperatureArray()
    {
        $temperatureArray = [
            "value" => 54,
            "unit"  => "celsius"
        ];

        $fermentationObject = Fermentation::fromArray($temperatureArray);

        $this->assertInstanceOf(
            Fermentation::class,
            $fermentationObject,
            "Fermentation::fromArray() doesn't return a"
            . " Fermentation object."
        );
    }
}
