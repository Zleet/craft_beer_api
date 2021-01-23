<?php

use Zleet\PunkAPI;
use Zleet\PunkAPI\Beer;
namespace Zleet\PunkAPI;

/**
 * BeerCollectionTest.php
 *
 * A class for testing the creation of BeerCollection objects.
 *
 * PHP version 7.3
 *
 * @category Components
 * @package  Punk_API
 * @author   Michael McLarnon <michaelmclarnon@hotmail.co.uk>
 * @license  MIT License
 * @version  GIT: @0.1
 * @link     https://www.usedcarsni.com
 */
class BeerCollectionTest extends \PHPUnit\Framework\TestCase
{
    // a BeerCollection object, used for testing
    private $collectionOfBeers;
    // a single beer object, used for testing
    private $beerObject;

    /**
     * Build a BeerCollection object and a Beer object for testing.
     */
    protected function setUp(): void
    {
        // Read the JSON for a bunch of Beer objects from a local file
        $beersJson = file_get_contents('tests/sample_all_response.json');
        $beersInfo = json_decode($beersJson, 1);

        // loop through all the subarrays in beers info and, for each
        // subarray, build a Beer object. Store all the Beer objects in the
        // array $arrayOfBeerObjects
        $arrayOfBeerObjects = [];
        foreach ($beersInfo as $singleBeerInfo) {
            $beer = Beer::fromArray($singleBeerInfo);
            $arrayOfBeerObjects[] = $beer;
        }

        // use $arrayOfBeerObjects to create a new BeerCollection object
        $bunchOfBeers = new BeerCollection($arrayOfBeerObjects);

        // store the BeerCollection object for testing
        $this->collectionOfBeers = $bunchOfBeers;

        // read the JSON for a single beer from a local file
        $singleBeerJson = file_get_contents(
            'tests/single_beer_json.json');

        // build a new beer object from the decoded JSON nad store it for
        // testing
        $singleBeerInfo = json_decode($singleBeerJson, 1);
        $this->beerObject = Beer::fromArray($singleBeerInfo);
    }

    /**
     * Test creating a BeerCollection object
     */
    public function testCreatingABeerCollectionObject()
    {
        // build an array of Beer objects
        $arrayOfBeerObjects = [];
        for ($i = 0; $i < 9; ++$i) {
            $arrayOfBeerObjects[] = $this->beerObject;
        }

        // use $arrayOfBeerObjects to create a new BeerCollection object
        $collectionOfBeers = new BeerCollection($arrayOfBeerObjects);

        // check that a new BeerCollection object has been created
        $this->assertInstanceOf(
            BeerCollection::class,
            $collectionOfBeers,
            "collectionOfBeers is not a BeerCollection object."
        );
    }

    /**
     * Test counting the Beer objects in a Beer Collection class
     */
    public function testCountingTheBeerObjectsInABeerCollection()
    {
        // build an array containing 9 Beer objects
        $arrayOfBeers = [];
        for ($i = 0; $i < 9; ++$i) {
            $arrayOfBeers[] = $this->beerObject;
        }

        // build a new BeerCollection object containing the 9 Beer objects
        $collectionOfBeers = new BeerCollection($arrayOfBeers);

        // check that BeerCollection->count() returns 9
        $this->assertEquals(
            9,
            $collectionOfBeers->count(),
            "BeerCollection->count() doesn't return the total Beer"
            . " objects in the BeerCollection object."
        );
    }

    /**
     * Check that we can rewind our position in a BeerCollection object
     */
    public function testThatWeCanRewindPositionInABeerCollection()
    {
        // get the first Beer object in the test BeerCollection object
        $firstBeer = $this->collectionOfBeers->current();

        // move to the second position in the BeerCollection, then
        // rewind position
        $this->collectionOfBeers->next();
        $this->collectionOfBeers->rewind();

        // get the Beer object at the current position and check that it's
        // the same as the Beer in the first position
        $currentBeer = $this->collectionOfBeers->current();
        $this->assertEquals(
            $firstBeer,
            $currentBeer,
            "BeerCollection->rewind() isn't working."
        );
    }
}
