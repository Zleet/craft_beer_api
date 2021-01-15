<?php

use Zleet\PunkAPI\Temperature;
use Zleet\PunkAPI\MashTemperature;
use Zleet\PunkAPI\Fermentation;
use Zleet\PunkAPI\Method;

/**
 * Class MethodTest - tests for the Method class
 */
class MethodTest extends \PHPUnit\Framework\TestCase
{
    // private property to hold the Method object that is constructed by
    // _ before testing
    private $methodObject;

    // set up a Method object for use in testing
    protected function setUp(): void
    {
        $temperature = new Temperature('45', 'celcius');
        $mashTemperature = new MashTemperature($temperature, 99);
        $fermentation = new Fermentation($temperature);
        $this->methodObject = new Method($mashTemperature, $fermentation, 'A tasty lemon.');
    }

    /**
     * Test creating a Method class
     */
    public function testClassCreation()
    {
        $this->assertInstanceOf(Method::class, $this->methodObject);
    }

    /**
     * Test creating a Method object and subsequently retrieving
     * its MashTemperature property
     */
    public function testGetMashTemperature()
    {
        $this->assertInstanceOf(MashTemperature::class,
            $this->methodObject->getMashTemperature());
    }

    /**
     * Test creating a Method object then retrieving the Fermentation
     * property from it
     */
    public function testGettingFermentation()
    {
        $this->assertInstanceOf(Fermentation::class,
            $this->methodObject->getFermentation());

    }

    /**
     * Test getting the twist property from a Method object
     */
    public function testGettingTwist()
    {
        $this->assertEquals('A tasty lemon.', $this->methodObject->getTwist());
    }

    /**
     * Test generating an array representation of a Method object
     */
    public function testGettingMethodAsAnArray()
    {
        $this->assertIsArray($this->methodObject->toArray(), "method->toArray() does not return an array");
    }

}