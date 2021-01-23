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

    /**
     * Test we can get the current position in the BeerCollection.
     */
    public function testWeCanGetTheCurrentPositionInTheBeerCollection()
    {
        // rewind to the first position in the BeerCollection
        $this->collectionOfBeers->rewind();

        // move to position number three (i.e. the fourth position)
        // in the BeerCollection
        for ($i = 0; $i < 3; ++$i) {
            $this->collectionOfBeers->next();
        }

        // check that we're at position number three
        $this->assertEquals(
            3,
            $this->collectionOfBeers->key(),
            "BeerCollection->key() doesn't return the current"
            . " position in the BeerCollection object."
        );
    }

    /**
     * Test that BeerCollection->current() returns a Beer object
     */
    public function testWeCanGetABeerObjectFromTheBeerCollectionObject()
    {
        $this->assertInstanceOf(
            Beer::class,
            $this->collectionOfBeers->current(),
            "BeerCollection->current() doesn't return a Beer object."
        );
    }

    /**
     * Test that BeerCollection->next() moves us to the next position
     * in a BeerCollection object
     */
    public function testWeCanMoveToTheNextPositionInABeerCollection()
    {
        // get the original position in the BeerCollection object
        $originalPosition = $this->collectionOfBeers->key();
        // move to the next position in the BeerCollection object
        $this->collectionOfBeers->next();
        $currentPosition = $this->collectionOfBeers->key();
        // check that:
        // <current position in BeerCollection object>
        // = <original position in BeerCollection object> + 1
        $this->assertEquals(
            $originalPosition + 1,
            $currentPosition,
            "BeerCollection->next() doesn't move to the next"
            . " position in a BeerCollection object."
        );
    }

    /**
     * Test that BeerCollection->valid() returns the correct value for
     * valid and invalid cursor positions.
     */
    public function testValidAndInvalidCursorPositionsInBeerCollection()
    {
        // unset cursor position 2 in the BeerCollection object
        unset($this->collectionOfBeers[2]);

        // set the cursor position to 2
        $this->collectionOfBeers->rewind();
        $this->collectionOfBeers->next();
        $this->collectionOfBeers->next();

        // check that BeerCollection->valid(2) returns false
        $this->assertEquals(
            false,
            $this->collectionOfBeers->valid(),
            "BeerCollection->valid() doesn't return false for an"
            . " invalid position."
        );

        // assign a Beer object to cursor position 5 in the BeerCollection
        // object
        $this->collectionOfBeers[5] = $this->beerObject;

        // move to cursor position 5 in the BeerCollection object
        $this->collectionOfBeers->rewind();
        for ($i = 0; $i < 5; ++$i) {
            $this->collectionOfBeers->next();
        }

        // check that BeerCollection->valid() returns true
        $this->assertEquals(
            true,
            $this->collectionOfBeers->valid(),
            "BeerCollection->valid() doesn't return true for a"
            . " valid cursor position."
        );
    }

    /**
     * Test that BeerCollection->offsetExists():
     * 1. returns true when a Beer exists at provided offset, and
     * 2. returns false when a Beer doesn't exist at the provided offset
     */
    public function testOffsetExistsWorksCorrectly()
    {
        // set offset 2 in the BeerCollection object
        $this->collectionOfBeers[2] = $this->beerObject;

        // check that BeerCollection->offsetExists(2) returns true
        $this->assertEquals(
            true,
            $this->collectionOfBeers->offsetExists(2),
            "BeerCollection->offsetExists() doesn't return true"
            . " for a set cursor position."
        );

        // unset offset 5 in the BeerCollection object
        unset($this->collectionOfBeers[5]);
        // check that BeerCollection->offsetExists(5) returns false
        $this->assertEquals(
            false,
            $this->collectionOfBeers->offsetExists(5),
            "BeerCollection->offsetExists() doesn't return false"
            . " for a cursor position that doesn't exist."
        );
    }

    /**
     * Test that BeerCollection->offsetGet returns a Beer object
     */
    public function testThatOffsetGetWorksCorrectly()
    {
        // set BeerCollection[7] to be a Beer object
        $this->collectionOfBeers[7] = $this->beerObject;
        // check that BeerCollection->offsetGet(7) returns a Beer object
        $this->assertInstanceOf(
            Beer::class,
            $this->collectionOfBeers->offsetGet(7),
            "BeerCollection->offsetGet() doesn't return a Beer"
            ." object when the specified offset actually contains a Beer"
            . " object."
        );
    }

    /**
     * Test that we can store a Beer object in the BeerCollection object
     * using the offsetSet() method.
     */
    public function testThatWeCanStoreABeerObjectUsingOffsetSet()
    {
        // store a beer object at position 9 in the BeerCollection object
        $this->collectionOfBeers->offsetSet(9, $this->beerObject);
        // check that there's a beer object stored at offset 9 in the
        // BeerCollection object
        $this->assertInstanceOf(
            Beer::class,
            $this->collectionOfBeers[9],
            "BeerCollection->offsetSet() doesn't set a Beer object"
            . " in the BeerCollection object."
        );
    }

    /**
     * Test that we can use BeerCollection->offsetUnset() to remove a Beer
     * object from the BeerCollection object.
     */
    public function testThatWeCanRemoveABeerUsingOffsetUnset()
    {
        // unset the Beer object at position 4
        unset($this->collectionOfBeers[4]);
        // check that there's no Beer object at cursor position 4
        // in the BeerCollection object
        $this->assertEquals(
            false,
            $this->collectionOfBeers->offsetExists(4),
            "BeerCollection->offsetUnset() doesn't remove a Beer"
            . " object from the BeerCollection object."
        );
    }
}
