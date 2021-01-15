<?php

use Zleet\PunkAPI\Temperature;
use Zleet\PunkAPI\MashTemperature;
use Zleet\PunkAPI\Fermentation;
use Zleet\PunkAPI\Method;

class MethodTest extends \PHPUnit\Framework\TestCase
{
    public function testClassCreation()
    {
        $temperature = new Temperature('45', 'celcius');
        $mashTemperature = new MashTemperature($temperature, 99);
        $fermentation = new Fermentation($temperature);
        $method = new Method($mashTemperature, $fermentation, 'A tasty lemon.');

        $this->assertInstanceOf(Method::class, $method);
    }

    // test getting MashTemperature
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
    public function testGettingFermentation()
    {
        $temperature = new Temperature('45', 'celcius');
        $mashTemperature = new MashTemperature($temperature, 99);
        $fermentation = new Fermentation($temperature);
        $method = new Method($mashTemperature, $fermentation, 'A tasty lemon.');

        $this->assertInstanceOf(Fermentation::class,
            $method->getFermentation());

    }

    // test getting twist
    public function testGettingTwist()
    {
        $temperature = new Temperature('45', 'celcius');
        $mashTemperature = new MashTemperature($temperature, 99);
        $fermentation = new Fermentation($temperature);
        $method = new Method($mashTemperature, $fermentation, 'A tasty lemon.');

        $this->assertEquals('A tasty lemon.', $method->getTwist());
    }

    // test getting the Method object as an array
    public function testGettingMethodAsAnArray()
    {
        $temperature = new Temperature('45', 'celcius');
        $mashTemperature = new MashTemperature($temperature, 99);
        $fermentation = new Fermentation($temperature);
        $method = new Method($mashTemperature, $fermentation, 'A tasty lemon.');

        $this->assertIsArray($method->toArray(), "method->toArray() does not return an array");
    }

}