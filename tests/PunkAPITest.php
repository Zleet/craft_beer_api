<?php

use Zleet\PunkAPI\PunkAPI;
use Zleet\PunkAPI\Beer;
use Zleet\PunkAPI\BeerCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class PunkAPITest extends \PHPUnit\Framework\TestCase
{
//    private $client;
//
//    public function setup(): void
//    {
//        // Set up new Guzzle client
//        $this->client = new Client();
//
//        // TODO: additional configuration of Guzzle client here
//    }

    /**
     * Test creating a PunkAPI object
     */
    public function testCreatingAPunkAPIObject()
    {
        $punkAPI = new PunkAPI();

        $this->assertInstanceOf(PunkAPI::class, $punkAPI);
    }

    /**
     * Test retrieving the information for a single beer with a valid id
     */
    public function testGetOneBeerWithAValidId()
    {
        // read the json for a single beer response from the local file
        $singleBeerJson = file_get_contents('tests/single_beer_json.json');

        // create a mock and queue a single response
        $mock = new MockHandler(
            [
                new Response(200, [], $singleBeerJson)
            ]
        );
        $handlerStack = HandlerStack::create($mock);

        // create a new Guzzle\Http client, configured to use the custom handler
        // stack we've just created
        $client = new Client(
            [
                'handler' => $handlerStack
            ]
        );

        // create a new PunkAPI object and inject the client with mocks into
        // the PunkAPI constructor
        $punkAPI = new PunkAPI($client);

        // attempt to retrieve the information for the beer with id 1
        // (should return a Beer object)
        $beer = $punkAPI->single(1);

        // check that we've got a beer object back
        $this->assertInstanceOf(
            Beer::class,
            $beer,
            "PunkAPI->single() didn't return a Beer object."
        );
    }

    /**
     * Test retrieving the information for a single beer if we submit
     * an invalid id.
     */
    public function testGettingASingleBeerWithAnInvalidId()
    {
        // create a mock and queue a single response
        $mock = new MockHandler(
            [
                new Response(404, [], '')
            ]
        );
        $handlerStack = HandlerStack::create($mock);

        // create a new Guzzle\Http client, configured to use the custom handler
        // stack we've just created
        $client = new Client(
            [
                'handler' => $handlerStack
            ]
        );

        // create a new PunkAPI object and inject the client with mocks into
        // the PunkAPI constructor
        $punkAPI = new PunkAPI($client);

        // test whether an exception is thrown by PunkAPI->single() when we
        // attempt to retrieve the single beer information with an invalid
        // beer id
        $this->expectException(GuzzleHttp\Exception\ClientException::class);

        // attempt to retrieve the information for the beer with id 99500
        // (should return a Beer object)
        $beer = $punkAPI->single(strval(99500));
    }

//    /**
//     * Test getting the information for a single beer using the actual Punk API
//     */
//    public function testGettingSingleBeerInformationUsingActualAPI()
//    {
//        // create a new PunkAPI object. Don't pass in a custom handle with
//        // mocks for API replies. By omitting the handle parameters, we'll
//        // ensure that the PenkAPI object actually contacts the Punk API
//        // for the beer information
//        $punkAPI = new PunkAPI();
//
//        // attempt to retrieve the information for the beer with id 5
//        // (should return a Beer object)
//        $beer = $punkAPI->single(5);
//
//        // check that we've got a beer object back
//        $this->assertInstanceOf(
//            Beer::class,
//            $beer,
//            "PunkAPI->single() didn't return a Beer object."
//        );
//    }

    /**
     * Test retrieving the information for a random beer.
     */
    public function testGettingARandomBeer()
    {
        // read the json for a single beer response from the local file
        $randomBeerJson = file_get_contents('tests/single_beer_json.json');

        // create a mock and queue a single response
        $mock = new MockHandler(
            [
                new Response(200, [], $randomBeerJson)
            ]
        );
        $handlerStack = HandlerStack::create($mock);

        // create a new Guzzle\Http client, configured to use the custom handler
        // stack we've just created
        $client = new Client(
            [
                'handler' => $handlerStack
            ]
        );

        // create a new PunkAPI object and inject the client with mocks into
        // the PunkAPI constructor
        $punkAPI = new PunkAPI($client);

        // attempt to retrieve the information for a random beer
        // (should return a Beer object)
        $beer = $punkAPI->random();

        // check that we've got a beer object back
        $this->assertInstanceOf(
            Beer::class,
            $beer,
            "PunkAPI->random() didn't return a Beer object."
        );
    }

    /**
     * Test getting all the beers.
     */
    public function testGettingAllTheBeers()
    {
        // read the JSON for all the beers from a local file
        $allBeersJson = file_get_contents(
            'tests/stubs/all_beers_json.json');

        // create a mock and queue a single response
        $mock = new MockHandler(
            [
                new Response(200, [], $allBeersJson)
            ]
        );
        $handlerStack = HandlerStack::create($mock);

        // create a new Guzzle\Http client, configured to use the custom handler
        // stack we've just created
        $client = new Client(
            [
                'handler' => $handlerStack
            ]
        );

        // create a new PunkAPI object and inject the client with mocks into
        // the PunkAPI constructor
        $punkAPI = new PunkAPI($client);

        // attempt to retrieve the information for several beers
        // (in an array of Beer objects)
        $bunchOfBeers = $punkAPI->all();

        // loop through all the elements in the array $bunchOfBeers and check
        // that they're all Beer objects
        foreach ($bunchOfBeers as $beer) {
            $this->assertInstanceOf(
                Beer::class,
                $beer,
                "In the array returned by PunkAPI->all(), not all"
                . " elements are Beer objects."
            );
        }

        // check that a BeerCollection object has been returned
        $this->assertInstanceOf(
            BeerCollection::class,
            $bunchOfBeers,
            "punkAPI->all() doesn't return a BeerCollection object."
        );
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
    
}
