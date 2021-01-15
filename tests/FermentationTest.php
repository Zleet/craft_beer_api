<?php

use Zleet\PunkAPI\Temperature;
use Zleet\PunkAPI\Fermentation;

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
    public function testGettingTemperature()
    {
        $temperature = new Temperature('39', 'fahrenheit');
        $fermentation = new Fermentation($temperature);

        $this->assertInstanceOf(Temperature::class, $fermentation->getTemperature(), 'Fermentation->getTemperature does not return a Temperature object.');
    }

    // test getting Fermentation object as array
    public function testGettingFermentationObjectAsArray()
    {
        $temperature = new Temperature('39', 'fahrenheit');
        $fermentation = new Fermentation($temperature);

        $this->assertIsArray($fermentation->toArray(), "fermentation->toArray() does not return an array.");
    }
}