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
    public function testGettingAnId()
    {
        $this->assertEquals(1, $this->beerObject->getId(),
            'Beer->getId() does not return 1');
    }

    // test getting name
    public function testGettingTheName()
    {
        $this->assertEquals('Buzz', $this->beerObject->getName(),
            "Beer->getName() doesn't return 'Buzz'");
    }

    // test getting tagline
    public function testGettingTheTagline()
    {
        $this->assertEquals(
            'A Real Bitter Experience.',
            $this->beerObject->getTagline(),
            "Beer->getTagline() doesn't return 'A Real Bitter Experience.'"
        );

    }

    // test getting firstBrewed
    public function testGettingFirstBrewed()
    {
        $this->assertEquals("09/2007",
            $this->beerObject->getFirstBrewed(),
            "Beer->getFirstBrewed() doesn't return '09/2007'"
        );
    }

    // test getting description
    public function testGettingDescription()
    {
        $this->assertEquals("A light, crisp and bitter IPA brewed with English and American hops. A small batch brewed only once.",
            $this->beerObject->getDescription(),
            "Beer->getDescription() doesn't return:\nA light, crisp and bitter IPA brewed with English and American hops. A small batch brewed only once."
        );
    }

    // test getting imageUrl
    public function testGettingImageUrl()
    {
        $this->assertEquals("https://images.punkapi.com/v2/keg.png",
            $this->beerObject->getImageUrl(),
            "Beer->getImageUrl() doesn't return https://images.punkapi.com/v2/keg.png"
        );
    }

    // test getting abv
    public function testGettingAbv()
    {
        $this->assertEquals(4.5,  $this->beerObject->getAbv(),
            "Beer->getAbv() doesn't return 4.5"
        );
    }

    // test getting ibu
    public function testGettingIbu()
    {
        $this->assertEquals(60,  $this->beerObject->getIbu(),
            "Beer->getIbu() doesn't return 60"
        );
    }

    // test getting targetFg
    public function testGettingTargetFg()
    {
        $this->assertEquals(1010,  $this->beerObject->getTargetFg(),
            "Beer->getTargetFg() doesn't return 1010"
        );
    }

    // test getting targetOg
    public function testGettingTargetOg()
    {
        $this->assertEquals(1044,  $this->beerObject->getTargetOg(),
            "Beer->getTargetOg() doesn't return 1044"
        );
    }

    // test getting ebc
    public function testGettingEbc()
    {
        $this->assertEquals(20,  $this->beerObject->getEbc(),
            "Beer->getEbc() doesn't return 20"
        );
    }

    // test getting srm
    public function testGettingSrm()
    {
        $this->assertEquals(10,  $this->beerObject->getSrm(),
            "Beer->getSrm() doesn't return 10"
        );
    }

    // test getting ph
    public function testGettingPh()
    {
        $this->assertEquals(4.4,  $this->beerObject->getPh(),
            "Beer->getPh() doesn't return 4.4"
        );
    }

    // test getting attenuationLevel
    public function testGettingAttenuationLevel()
    {
        $this->assertEquals(
            75,
            $this->beerObject->getAttenuationLevel(),
            "Beer->getAttenuationLevel() doesn't return 75"
        );
    }

    // test getting volume
    public function testGettingVolume()
    {
        // check that getVolume() returns a Volume object
        $this->assertInstanceOf(
            Volume::class,
            $this->beerObject->getVolume(),
            "Beer->getVolume() doesn't return a Volume object.");
    }

    // test getting boilVolume
    public function testGettingBoilVolume()
    {
        // check that getBoilVolume() returns a BoilVolume object
        $this->assertInstanceOf(
            BoilVolume::class,
            $this->beerObject->getBoilVolume(),
            "Beer->getBoilVolume() doesn't return a BoilVolume object.");
    }

    // test getting Method property
    public function testGettingMethod()
    {
        // check that getMethod() returns a Method object
        $this->assertInstanceOf(
            Method::class,
            $this->beerObject->getMethod(),
            "Beer->getMethod doesn't return a Method object."
        );
    }

    // test getting ingredients
    public function testGettingIngredients()
    {
        // check that Beer->getIngredients() returns an Ingredients object
        $this->assertInstanceOf(
            Ingredients::class,
            $this->beerObject->getIngredients(),
            "beerObject->getIngredients() doesn't return an Ingredients object."
        );
    }

    // test getting foodPairing
    public function testGettingFoodPairing()
    {
        // check that Beer->getFoodPairing() returns an array
        $this->assertIsArray(
            $this->beerObject->getFoodPairing(),
            'Beer->getFoodPairing() does not return an array.'
        );
        // check that all of the elements in the array returned by
        // Beer->getFoodPairing() are strings
        $foodPairingArray = $this->beerObject->getFoodPairing();
        foreach ($foodPairingArray as $foodPairingElement) {
            $this->assertIsString(
                $foodPairingElement,
                "Not every element in the array returned by Beer->getFoodPairing() is a string."
            );
        }
    }

    // test getting brewersTips
    public function testGettingBrewersTips()
    {
        // check that Beer->getBrewersTips() returns the correct string
        $this->assertEquals(
            'The earthy and floral aromas from the hops can be overpowering. Drop a little Cascade in at the end of the boil to lift the profile with a bit of citrus.',
            $this->beerObject->getBrewersTips(),
            "Beer->getBrewersTips() does not return the correct string."
        );
    }

    // test getting contributedBy
    public function testGettingContributedBy()
    {
        // check that Beer->getContributedBy() returns the correct string
        $this->assertEquals(
            'Sam Mason <samjbmason>',
            $this->beerObject->getContributedBy(),
            'Beer->getContributedBy() does not return "Sam Mason <samjbmason>"'
        );
    }

    /**
     * Test building a new Beer object from an array.
     */
    public function testBuildingABeerObjectFromAnArray()
    {
        // read Beer information from local file
        $singleBeerInfo = file_get_contents('tests/single_beer_json.json');
        $singleBeerInfo = json_decode($singleBeerInfo, 1);

        // test print
        echo "\nsingleBeerInfo:\n";
        print_r($singleBeerInfo);

        $beer = Beer::fromArray($singleBeerInfo);

        $this->assertInstanceOf(Beer::class, $beer);
    }

    // test getting an array representation of a Beer object

    // test all of the methods required in the spec
    // (i.e. fetch a single beer, fetch a random beer, fetch all the beers etc.)

}
