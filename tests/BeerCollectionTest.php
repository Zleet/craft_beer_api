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
    /**
     * Test creating a BeerCollection object
     */
    public function testCreatingABeerCollectionObject()
    {
        // read the JSON for a bunch of Beer objects from a local file
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
        $collectionOfBeers = new BeerCollection($arrayOfBeerObjects);

        // check that a new BeerCollection object has been created
        $this->assertInstanceOf(
            BeerCollection::class,
            $collectionOfBeers,
            "collectionOfBeers is not a BeerCollection object."
        );
    }
}
