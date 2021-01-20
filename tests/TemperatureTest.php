<?php

namespace Zleet\PunkAPI;

class TemperatureTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test creating a class
     */
    public function testClassCreation()
    {

        $temperature = new Temperature(15, "celcius");

        $this->assertInstanceOf(Temperature::class, $temperature);
    }

    /**
     * Test getting the value property
     */
    public function testGetValue()
    {
        $temperature = new Temperature(15, "celcius");

        $this->assertEquals(15, $temperature->getValue(), "Value returned from Temperature object was incorrect.");
    }

    /**
     * Test getting the unit value
     */
    public function testGetUnit()
    {
        $temperature = new Temperature(15, "celcius");

        $this->assertEquals("celcius", $temperature->getUnit(), "Unit returned from Temperature object was incorrect.");
    }

    /**
     * Test outputting a Temperature object as an array
     */
    public function testConvertTemperatureToArray()
    {
        $temperature = new Temperature(15, "celcius");

        $this->assertIsArray($temperature->toArray());
    }

    /**
     * Test creating a Temperature object from an array.
     */
    public function testCreatingTemperatureFromArray()
    {
        $temperatureArray = [
            "value" => 31,
            "unit"  => "celsius"
        ];

        $temperatureObject = Temperature::fromArray($temperatureArray);

        $this->assertInstanceOf(
            Temperature::class,
            $temperatureObject,
            "Temperature::fromArray() doesn't return a Temperature"
            . " object."
        );
    }
}
