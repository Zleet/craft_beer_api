<?php

use Zleet\PunkAPI\Volume;
use Zleet\PunkAPI\BoilVolume;
use Zleet\PunkAPI\Temperature;
use Zleet\PunkAPI\MashTemperature;
use Zleet\PunkAPI\Fermentation;
use Zleet\PunkAPI\Method;
use Zleet\PunkAPI\Amount;
use Zleet\PunkAPI\Malt;
use Zleet\PunkAPI\Hop;
use Zleet\PunkAPI\Ingredients;
use Zleet\PunkAPI\Beer;

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
        $beer = $this->createBeerObjectForTesting();

        // store the beer object for testing
        $this->beerObject = $beer;
    }

    /**
     * Helper function for the setUp() method. Builds a Beer object from a JSON
     * file which contains all the information for a Beer object.
     */
    private function createBeerObjectForTesting()
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
            $beerInfo["volume"]["unit"]
        );

        // build a BoilVolume value object
        $boilVolume = new BoilVolume(
            $beerInfo["boil_volume"]["value"],
            $beerInfo["boil_volume"]["unit"]
        );

        // build a Temperature value object to place inside the MashTemperature
        // value object
        $temperature1 = new Temperature(
             $beerInfo["method"]["mash_temp"][0]["temp"]["value"],
             $beerInfo["method"]["mash_temp"][0]["temp"]["unit"]
        );
        // build a MashTemperature value object
        $mashTemperature = new MashTemperature(
            $temperature1,
            $beerInfo["method"]["mash_temp"][0]["duration"]
        );
        // create an array to hold the single MashTemperature object
        $mashTemperatures = [$mashTemperature];
        // build a Temperature value object to place inside the Fermentation
        // value object
        $temperature2 = new Temperature(
            $beerInfo["method"]["fermentation"]["temp"]["value"],
            $beerInfo["method"]["fermentation"]["temp"]["unit"]
        );
        // build a Fermentation value object
        $fermentation = new Fermentation($temperature2);
        // build a Method value object (use the array of one Mash Temperature
        // object and the Fermentation object, built above, along with the
        // twist string value from $beerInfo to create it)
        $method = new Method(
            $mashTemperatures,
            $fermentation,
            $beerInfo["method"]["twist"]
        );
        // build an array of Malt objects
        $maltArrays = $beerInfo["ingredients"]["malt"];
        $arrayOfMaltObjects = [];
        foreach ($maltArrays as $maltArray) {
            // build new Amount object
            $amountObject = new Amount(
                $maltArray["amount"]["value"],  // value
                $maltArray["amount"]["unit"]    // unit
            );
            // build new Malt object
            $maltObject = new Malt(
                $maltArray["name"], // name
                $amountObject       // amount
            );
            // store the Malt object
            $arrayOfMaltObjects[] = $maltObject;
        }
        // build an array of Hop objects
        $hopArrays = $beerInfo["ingredients"]["hops"];
        $arrayOfHopObjects = [];
        foreach ($hopArrays as $hopArray) {
            // build new amount object
            $amountObject = new Amount(
                $hopArray["amount"]["value"],  // value
                $hopArray["amount"]["unit"]    // unit
            );
            // build new Hop object
            $hopObject = new Hop(
                $hopArray["name"],      // name
                $amountObject,          // amount
                $hopArray["add"],       // add
                $hopArray["attribute"]  // attribute
            );
            // store the Hop object
            $arrayOfHopObjects[] = $hopObject;
        }
        // build a Ingredients value object (using the array of Malt objects,
        // the array of Hop objects and the yeast value from $beerInfo
        $ingredients = new Ingredients(
            $arrayOfMaltObjects,
            $arrayOfHopObjects,
            $beerInfo["ingredients"]["yeast"]
        );
        // build the Beer object (using information from $beerInfo, along with
        // several of the value objects created above)
        $beer = new Beer(
            $beerInfo["id"],                // id
            $beerInfo["name"],              // name
            $beerInfo["tagline"],           // tagline
            $beerInfo["first_brewed"],      // firstBrewed
            $beerInfo["description"],       // description
            $beerInfo["image_url"],         // imageUrl
            $beerInfo["abv"],               // abv
            $beerInfo["ibu"],               // ibu
            $beerInfo["target_fg"],         // targetFg
            $beerInfo["target_og"],         // targetOg
            $beerInfo["ebc"],               // ebc
            $beerInfo["srm"],               // srm
            $beerInfo["ph"],                // ph
            $beerInfo["attenuation_level"], // attenuationLevel
            $volume,                        // volume
            $boilVolume,                    // boilVolume
            $method,                        // method
            $ingredients,                   // ingredients
            $beerInfo["food_pairing"],      // foodPairing
            $beerInfo["brewers_tips"],      // brewersTips
            $beerInfo["contributed_by"]     // contributedBy
        );

        return $beer;
    }

    /**
     * Test creating a Beer class
     */
    public function testCreatingABeerObject()
    {
        $this->assertInstanceOf(Beer::class, $this->beerObject);
    }

    // ===========================
    // test all the getter methods
    // ===========================
    // test getting id
    // (bookmark 16/1/21 at 1658)

    // test getting name

    // test getting tagline

    // test getting firstBrewed

    // test getting description

    // test getting imageUrl

    // test getting abv

    // test getting ibu

    // test getting targetFg

    // test getting targetOg

    // test getting ebc

    // test getting srm

    // test getting ph

    // test getting attenuationLevel

    // test getting volume

    // test getting boilVolume

    // test getting method

    // test getting ingredients

    // test getting foodPairing

    // test getting brewersTips

    // test getting contributedBy

    // test getting an array version of the Beer class

    // test all of the methods required in the spec
    // (i.e. fetch a single beer, fetch a random beer, fetch all the beers etc.)


}