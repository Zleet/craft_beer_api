<?php

use Zleet\PunkAPI;
namespace Zleet\PunkAPI;


class MashTemperatureTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test creating a class
     */
    public function testClassCreation()
    {
        $temperature = new Temperature(15, 'fahrenheit');
        $mashTemperature = new MashTemperature($temperature, 37);

        $this->assertInstanceOf(MashTemperature::class, $mashTemperature);
    }

    /**
     * Test getting the temperature property (in object form) from
     * a MashTemperature object
     */
    public function testGettingTheTemperature()
    {
        $temperature = new Temperature(15, 'fahrenheit');
        $mashTemperature = new MashTemperature($temperature, 37);

        $this->assertInstanceOf(Temperature::class, $mashTemperature->getTemperature());
    }

    /**
     * Test getting the duration
     */
    public function testGettingTheDuration()
    {
        $temperature = new Temperature(15, 'fahrenheit');
        $mashTemperature = new MashTemperature($temperature, 37);

        $this->assertEquals('37',$mashTemperature->getDuration(), 'MashTemperature duration is incorrect.');


    }

    /**
     * test getting the MashTemperature object as an array
     */
    public function testGettingMashTemperatureAsArray()
    {
        $temperature = new Temperature(15, 'fahrenheit');
        $mashTemperature = new MashTemperature($temperature, 37);

        $this->assertIsArray($mashTemperature->toArray());
    }

    /**
     * Test building a MashTemperature object from an array
     */
    public function testBuildingAMashTemperatureFromAnArray()
    {
        $mashTemperatureInfo = [
            "temp" => [
                "value"=> 64,
                "unit" => "celsius"
            ],
            "duration" => 75
        ];

        $mashTemperatureObject = MashTemperature::fromArray($mashTemperatureInfo);

        $this->assertInstanceOf(
            MashTemperature::class,
            $mashTemperatureObject);
    }
}
