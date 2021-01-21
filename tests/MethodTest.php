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
    // private property to hold the Method object created for testing
    private $methodObject;

    // set up a Method object for use in testing
    protected function setUp(): void
    {
        $temperature = new Temperature('45', 'celcius');
        $mashTemperature = new MashTemperature($temperature, 99);
        $mashTemperatures = [$mashTemperature];
        $fermentation = new Fermentation($temperature);
        $this->methodObject = new Method($mashTemperatures, $fermentation, 'A tasty lemon.');
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
    public function testGetMashTemperatures()
    {
        // check that Method->getMashTemperatures() returns an array
        $this->assertIsArray($this->methodObject->getMashTemperatures(), 'Method->getMashTemperatures() does not return an array.');

        // check that all the elements in the $mashTemperatures array are
        // MashTemperature objects
        foreach ($this->methodObject->getMashTemperatures() as $mashTemperature) {
            $this->assertInstanceOf(
                MashTemperature::class,
                $mashTemperature,
                'Not every element in the array returned by Method->getMashTemperatures is a MashTemperature object.'
            );
        }
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

    /**
     * Test building a Method object from an array
     */
    public function testBuildingAMethodObjectFromAnArray()
    {
        $singleBeerJson = file_get_contents(
            "tests/single_beer_json.json");
        $singleBeerInfo = json_decode($singleBeerJson, 1);
        $methodInfo = $singleBeerInfo["method"];

        $methodObject = Method::fromArray($methodInfo);

        $this->assertInstanceOf(Method::class, $methodObject);
    }
}
