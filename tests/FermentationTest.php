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

        // $this->assertInstanceOf('', '', '');
        // bookmark (14/1/21 at 1651)
    }

    // test getting Fermentation object as array
    // CODE HERE

}