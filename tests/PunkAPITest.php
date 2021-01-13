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

    public function testGetOneBeer()
    {

        $punkAPI = new PunkAPI();

        // fetch the information for the beer with ID 1 in object form
        $beer = $punkAPI->single(1);

        // test print the Beer object
        echo "\nbeer:\n";
        print_r($beer);

        // test that the single() method returns an object
        $this->assertIsObject($beer,
            "The single() method does not return an object.");

        // test that the tagline returned for the beer with ID 1 is
        // 'A Real Bitter Experience'
        $this->assertEquals("A Real Bitter Experience.",
            $beer->getTagline());

        // check that the API has returned an object containing all the right
        // properties
        $propertiesToCheck = [
            "id", "name", "tagline", "first_brewed", "description", "image_url",
            "abv", "ibu", "target_fg", "target_og", "ebc", "srm", "ph",
            "attenuation_level", "volume", "boil_volume", "method",
            "ingredients", "food_pairing", "brewers_tips",
            "contributed_by"
        ];
        $propertiesAndValues = get_object_vars($beer);
        $beerProperties = array_keys($propertiesAndValues);
        foreach ($beerProperties as $currentProperty) {
            $this->assertArrayHasKey($currentProperty, $beerProperties,
                "Key '" . $currentProperty
                . " not present in single beer API response.");
        }

    }

    /**
     * Helper function for testGetOneBeer.
     * Converts a json key in the format 'attenuation_level' to a getter method
     * name in the format 'getAttenuationLevel'
     */
    private function convertJsonKeyToGetterMethodName($jsonKey)
    {
        // split json key into words
        $words = explode('_', $jsonKey);
        // build getter method name
        $getterMethodName = 'get';
        // loop through words and append them all with each first letter
        // capitalised
        $totalWords = count($words);
        for ($i = 0; $i < $totalWords; ++$i) {
            $word = $words[$i];
            $firstLetter = substr($word, 0, 1);
            $getterMethodName .= strtoupper($firstLetter);
            if (strlen($word) > 1) {
                $restOfWord = substr($word, 1);
                $getterMethodName .= $restOfWord;
            }
        }

        return $getterMethodName;
    }

    /**
     * Helper function for testGetOneBeer.
     * Converts a json key in the format 'attenuation_level' to a property name
     * in the format 'attenuationLevel'
     */
    private function convertJsonKeyToObjectProperty($jsonKey) {

        // split $jsonKey along underscores
        $words = explode('_', $jsonKey);

        // build property name
        $propertyName = $words[0];

        $totalWords = count($words);
        if ($totalWords == 1) {
            return $propertyName;
        }

        for ($i = 1; $i < $totalWords; ++$i) {
            $word = $words[$i];
            // add first letter, capitalised
            $firstLetter = substr($word, 0, 1);
            $propertyName .= strtoupper($firstLetter);
            // add rest of word
            if (strlen($word) > 1) {
                $restOfWord = substr($word, 1);
                $propertyName .= $restOfWord;
            }
        }

        return $propertyName;
    }




    /**
     * Test setting the ids value using a bad id string. The ids value for a
     * PunkAPI object should be a string that consists only of the characters in
     * '0123456789| '.
     */
    public function testSettingABadId()
    {
        // create a new PunkAPI object with default properties
        $punkApi = new PunkAPI();

        // attempt to set the id property with a string containing bad
        // characters
        $punkApi->setIds('34r|3g|dsgsdg|45|23g|bb3|g');

        // check that the bad value for id was not set and it is actually still
        // the default value (i.e. an empty string)
        $this->assertEquals('', $punkApi->getIds(),
            'PunkAPI object allows setting of ID property with '
            . 'invalid characters (i.e. characters not in "0123456789 |").');
    }

    /**
     * Test setting the ids value using a good id string. The ids value for a
     * PunkAPI object should be a string that consists only of the characters in
     * '0123456789| '.
     */
    public function testSettingAGoodId()
    {
        // create a new PunkAPI object with default properties
        $punkApi = new PunkAPI();

        // attempt to set the id property with a string containing all good
        // characters
        $punkApi->setIds('34|3|45|23|3');

        // check that the good value for id was set
        $this->assertEquals('34|3|45|23|3', $punkApi->getIds(),
            "PunkAPI object won't allow an ids value with a valid "
            . "id string to be set. (i.e. an id string containing only "
            . 'the characters in "0123456789 |"');
    }

    // test getting a random beer
    public function testGettingARandomBeer() {

        $punkApi = new PunkApi();

        $randomBeer = $punkApi->random();

        $this->assertIsArray($randomBeer, 'The random() method does'
            . " not return an array.");

        // test print
        $punkApi->all();
    }

    // test the all() method for retrieving all beers
    public function testGettingAllBeers() {

        $punkApi = new PunkApi();

        $beers = $punkApi->all();

        // test that an array of beers have been returned
        $this->assertIsArray($beers, 'The all() method does not return'
            . ' an array.');
    }

    // more tests here
    // CODE HERE


}
