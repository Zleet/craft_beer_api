<?php

use Zleet\PunkAPI\PunkAPI;
use GuzzleHttp\Client;

class PunkAPITest extends \PHPUnit\Framework\TestCase
{
    public function testClassCreation()
    {
        $punkAPI = new PunkAPI();

        $this->assertInstanceOf(PunkAPI::class, $punkAPI);
    }

    public function testDefaultPropertiesAreCorrect()
    {
        $punkAPI = new PunkAPI();

        // check default ABV upper and lower bounds are correct
        $this->assertEquals("0", $punkAPI->getAbvLowerBound(),
            'Default ABV lower bound is not zero!');
        $this->assertEquals("100", $punkAPI->getAbvUpperBound(),
            'Default ABV upper bound is not 100!');

        // check default IBU upper and lower bounds are correct
        $this->assertEquals("0", $punkAPI->getIbuLowerBound(),
            'Default IBU lower bound is not zero!');
        $this->assertEquals("100", $punkAPI->getIbuUpperBound(),
            'Default IBU upper bound is not 100!');

        // check default EBC upper and lower bounds are correct
        $this->assertEquals("2", $punkAPI->getEbcLowerBound(),
            'Default EBC lower bound is not 2!');
        $this->assertEquals("27", $punkAPI->getEbcUpperBound(),
            'Default EBC upper bound is not 27!');

        // check default beer
        $this->assertEquals("", $punkAPI->getBeer(),
                'Default beer is not an empty string.');

        // check default yeast
        $this->assertEquals("", $punkAPI->getYeast(),
            'Default yeast is not an empty string.');

        // check default hops
        $this->assertEquals("", $punkAPI->getHops(),
            'Default hops is not an empty string.');

        // check default malt
        $this->assertEquals("", $punkAPI->getMalt(),
            'Default malt is not an empty string.');

        // check default food
        $this->assertEquals("", $punkAPI->getFood(),
            'Default food is not an empty string.');

        // check default ids
        $this->assertEquals("", $punkAPI->getIds(),
            'Default IDs is not an empty string.');

        // check brewedAfter
        $this->assertMatchesRegularExpression(
            "/[0-9]{2}-[0-9]{4}/",
            $punkAPI->getBrewedAfter());

        // check brewedBefore
        $this->assertMatchesRegularExpression(
            "/[0-9]{2}-[0-9]{4}/",
            $punkAPI->getBrewedBefore());
    }

    public function testGetOneBeer() {

        $punkAPI = new PunkAPI();

        // fetch the information for the beer with ID 1
        $singleBeerInfo = $punkAPI->single(1);

        // test print
        echo "\nSingle Beer Info:\n";
        print_r($singleBeerInfo);

        // test that the single() method returns an array
        $this->assertIsArray($singleBeerInfo,
            "The single() method does not return an array.");

        // test that the tagline returned for the beer with ID 1 is
        // 'A Real Bitter Experience'
        $this->assertEquals("A Real Bitter Experience.",
            $singleBeerInfo["tagline"]);

        // check that the "id" key is present in the response
        $this->assertArrayHasKey("id", $singleBeerInfo,
            "Key 'id' is not present in the API response.");

        // check that the API has returned all the proper keys in its response
        $keysToCheck = [
            "id", "name", "tagline", "first_brewed", "description", "image_url",
            "abv", "ibu", "target_fg", "target_og", "ebc", "srm", "ph",
            "attenuation_level", "volume", "boil_volume", "method",
            "ingredients", "food_pairing", "brewers_tips",
            "contributed_by"
        ];
        foreach ($keysToCheck as $currentKey) {
            $this->assertArrayHasKey($currentKey, $singleBeerInfo,
                "Key '" . $currentKey . " not present in single beer API response.");
        }

        // test a bunch of sample key/value pairs that should be returned with
        // the beer with ID 1
        $keysAndValuesToCheck = [
            "name"              => "Buzz",
            "tagline"           => "A Real Bitter Experience.",
            "first_brewed"      => "09/2007",
            "abv"               => 4.5,
            "ibu"               => 60,
            "target_fg"         => 1010,
            "target_og"         => 1044,
            "ebc"               => 20,
            "srm"               => 10,
            "ph"                => 4.4,
            "attenuation_level" => 75
        ];
        foreach($keysAndValuesToCheck as $keyToCheck => $valueToCheck) {
            $this->assertEquals($valueToCheck,
                $singleBeerInfo[$keyToCheck],
                "\nKey '" . $keyToCheck . "' should contain:\n"
                . $valueToCheck . "\nbut it actually contains:\n"
                . $singleBeerInfo[$keyToCheck]
            );
        }

        // check that all the keys which should have arrays as values actually
        // do
        $keysThatShouldHaveArrayValues = [
            "volume", "boil_volume", "method", "ingredients",
            "food_pairing"
        ];
        foreach ($keysThatShouldHaveArrayValues as $keyToCheckForArray) {
            $this->assertIsArray($singleBeerInfo[$keyToCheckForArray],
            "Key '" . $keyToCheckForArray
                . "' does not have an array value.");
        }

        // more single beer info checks here
        // CODE HERE

    }


    // more tests here
    // CODE HERE


}
