<?php

use Zleet\PunkAPI\Volume;
use Zleet\PunkAPI\BoilVolume;
use Zleet\PunkAPI\Temperature;
use Zleet\PunkAPI\MashTemperature;


/**
 * Class BeerTest - tests for the Beer class
 */
class BeerTest extends \PHPUnit\Framework\TestCase
{
    // private property to hold the Beer object that will be used for testing.
    private $beerObject;

    // set up a Beer object for use in testing
    protected function setUp(): void
    {
        // build the beer object
        $beer = $this->createBeerObjectFromJson();

        // store the beer object for testing
        $this->beerObject = $beer;
    }

    /**
     * Helper function for the setUp() method. Builds a Beer object from a JSON
     * file which contains all the information for a Beer object.
     */
    private function createBeerObjectFromJson()
    {
        // read all of the information required for setting up a Beer object for
        // testing from a local json file
        $beerJson = file_get_contents('tests/single_beer_json.json');
        $beerInfo = json_decode($beerJson, 1);

        // test print
        echo "\n\nbeerInfo:\n";
        print_r($beerInfo);
        echo "\n";

        // =================================================================
        // set up all the value objects that are used to build a Beer Object
        // =================================================================
        // build a Volume value object
        $volume = new Volume(
            $beerInfo["volume"]["value"],
            $beerInfo["volume"]["unit"],
        );

        // build a BoilVolume value object
        $beerVolume = new BoilVolume(
            $beerInfo["boil_volume"]["value"],
            $beerInfo["boil_volume"]["unit"],
        );

        // build a Temperature value object to place inside the MashTemperature
        // value object
        // bookmark ()
        // $temperature1 = new Temperature(
        //     64, //
        //     "celsius"
        // );
        // build a MashTemperature value object
        $mashTemperature = new MashTemperature($temperature1, '65');

        // build a Temperature value object to place inside the Fermentation
        // value object

        // build a Fermentation value object

        // build a Method value object

        // build a Ingredients value object

        // build the Beer object




        return $beer;
    }



    /**
     * Test creating a Beer class
     */
    public function testCreatingABeerObject()
    {
        // code here


    }


    // test all the getters


    // test getting an array version of the Beer class
}