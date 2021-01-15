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
    /**
     * Test creating a Method class
     */
    public function testClassCreation()
    {
        $temperature = new Temperature('45', 'celcius');
        $mashTemperature = new MashTemperature($temperature, 99);
        $fermentation = new Fermentation($temperature);
        $method = new Method($mashTemperature, $fermentation, 'A tasty lemon.');

        $this->assertInstanceOf(Method::class, $method);
    }

    /**
     * Test creating a Method object and subsequently retrieving
     * its MashTemperature property
     */
    public function testGetMashTemperature()
    {
        $temperature = new Temperature('45', 'celcius');
        $mashTemperature = new MashTemperature($temperature, 99);
        $fermentation = new Fermentation($temperature);
        $method = new Method($mashTemperature, $fermentation, 'A tasty lemon.');

        $this->assertInstanceOf(MashTemperature::class,
            $method->getMashTemperature());
    }

    // test getting Fermentation

    /**
     * Test creating a Method object then retrieving the Fermentation
     * property from it
     */
    public function testGettingFermentation()
    {
        $temperature = new Temperature('45', 'celcius');
        $mashTemperature = new MashTemperature($temperature, 99);
        $fermentation = new Fermentation($temperature);
        $method = new Method($mashTemperature, $fermentation, 'A tasty lemon.');

        $this->assertInstanceOf(Fermentation::class,
            $method->getFermentation());

    }

    /**
     * Test getting the twist property from a Method object
     */
    public function testGettingTwist()
    {
        $temperature = new Temperature('45', 'celcius');
        $mashTemperature = new MashTemperature($temperature, 99);
        $fermentation = new Fermentation($temperature);
        $method = new Method($mashTemperature, $fermentation, 'A tasty lemon.');

        $this->assertEquals('A tasty lemon.', $method->getTwist());
    }

    // test getting the Method object as an array

    /**
     * Test generating an array representation of a Method object
     */
    public function testGettingMethodAsAnArray()
    {
        $temperature = new Temperature('45', 'celcius');
        $mashTemperature = new MashTemperature($temperature, 99);
        $fermentation = new Fermentation($temperature);
        $method = new Method($mashTemperature, $fermentation, 'A tasty lemon.');

        $this->assertIsArray($method->toArray(), "method->toArray() does not return an array");
    }

}