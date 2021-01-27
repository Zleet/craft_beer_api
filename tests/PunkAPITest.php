<?php

use Zleet\PunkAPI\PunkAPI;
use Zleet\PunkAPI\Beer;
use Zleet\PunkAPI\BeerCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class PunkAPITest extends \PHPUnit\Framework\TestCase
{
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
                "In the array returned by PunkAPI->all(), not all elements are Beer objects."
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
            'PunkAPI object allows setting of ID property with invalid characters (i.e. characters not in "0123456789 |").');
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
            "PunkAPI object won't allow an ids value with a valid id string to be set. (i.e. an id string containing only the characters in '0123456789 |'"
        );
    }

    /**
     * Test setting the minimum abv in a Punk API object
     */
    public function testSettingTheMinimumAbvAndGettingTheSameValueBack()
    {
        $punkApi = new PunkAPI();

        // test setting a minimum ABV and getting the same value back
        $randomMinimumAbv = rand(1, 40);
        $punkApi->setAbvLowerBound($randomMinimumAbv);
        $this->assertEquals(
            $randomMinimumAbv,
            $punkApi->getAbvLowerBound(),
            "Attempted to set an ABV lower bound of " . $randomMinimumAbv . " in the PunkAPI object. But PunkAPI->getAbvLowerBound() returns " . $punkApi->getAbvLowerBound()
        );
    }

    /**
     * Test setting a minimum ABV that is too low (i.e. less than zero).
     */
    public function testSettingAMinimumAbvThatIsTooLow()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setAbvLowerBound(-5);
    }

    /**
     * Test setting a minimum ABV that is too high (i.e. greater than 100).
     */
    public function testSettingAMinimumAbvThatIsTooHigh()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setAbvLowerBound(107);
    }

    /**
     * Test setting a minimum ABV that is not an integer or a float
     */
    public function testSettingAMinimumAbvThatIsNotIntegerOrFloat()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setAbvLowerBound("garbage");
    }

    /**
     * Test setting the maximum abv in a Punk API object and getting the same
     * value back.
     */
    public function testSettingTheMaximumAbv()
    {
        $punkApi = new PunkAPI();

        // test setting a maximum ABV and getting the same value back
        $randomMaximumAbv = rand(60, 100);
        $punkApi->setAbvUpperBound($randomMaximumAbv);
        $this->assertEquals(
            $randomMaximumAbv,
            $punkApi->getAbvUpperBound()
        );
    }

    /**
     * Test setting a maximum ABV that is too low (less than zero)
     */
    public function testSettingAMaximumAbvThatIsTooLow()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setAbvUpperBound(-5);
    }

    /**
     * Test setting a maximum ABV that is too large (greater than 100).
     */
    public function testSettingAMaximumAbvThatIsTooHigh()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setAbvUpperBound(107);
    }

    /**
     * Test setting a maximum ABV that is not an integer or a float.
     */
    public function testSettingAMaximumAbvThatIsNotAnIntegerOrAFloat()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setAbvUpperBound("nonsense");
    }

    /**
     * Test setting the minimum IBU. IBU can range from 1 to 100 (inclusive).
     */
    public function testSettingMinimumIbuAndGettingSameValueBack()
    {
        $punkApi = new PunkAPI();

        // test setting a minimum IBU and getting the same value back
        $randomIbu = rand(60, 100);
        $punkApi->setIbuLowerBound($randomIbu);
        $this->assertEquals(
            $randomIbu,
            $punkApi->getIbuLowerBound()
        );
    }

    /**
     * Test setting a minimum IBU that is too low (i.e. less than 1).
     */
    public function testSettingAMinimumIbuThatIsTooLow()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setIbuLowerBound(0);
    }

    /**
     * Test setting a minimum IBU that is too high (i.e. above 100).
     */
    public function testSettingAMinimumIbuThatIsTooHigh()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setIbuLowerBound(102);
    }

    /**
     * Test setting a minimum IBU that is not an integer or a float.
     */
    public function testSettingAMinimumIbuThatIsNotAnIntegerOrAFloat()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setIbuLowerBound("rubbish");
    }

    /**
     * Test setting the maximum IBU and getting the same value back.
     * (IBU can range from 1 to 100.)
     */
    public function testSettingTheMaximumIbuAndGettingTheSameValueBack()
    {
        $punkApi = new PunkAPI();

        // test setting a maximum IBU and getting the same value back
        $randomIbu = rand(1, 100);
        $punkApi->setIbuUpperBound($randomIbu);
        $this->assertEquals(
            $randomIbu,
            $punkApi->getIbuUpperBound()
        );
    }

    /**
     * Test setting a maximum IBU that is too low (less than 1)
     */
    public function testSettingAMaximumIbuThatIsTooLow()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setIbuUpperBound(0);
    }

    /**
     * Test setting a maximum IBU that is too high (greater than 100)
     */
    public function testSettingAMaximumIbuThatIsTooHigh()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setIbuUpperBound(102);
    }

    /**
     * Test setting a maximum IBU that is neither an integer nor a float.
     */
    public function testSettingAMaximumIbuThatIsNotAnIntegerOrAFloat()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setIbuUpperBound("garbage in, garbage out");
    }

    /**
     * Test setting the minimum EBC and getting the same value back.
     * EBC can range from 2 to 27 (inclusive).
     */
    public function testSettingTheMinimumEbcAndGettingTheSameValueBack()
    {
        $punkApi = new PunkAPI();

        $randomEbc = rand(2, 27);
        $punkApi->setEbcLowerBound($randomEbc);
        $this->assertEquals(
            $randomEbc,
            $punkApi->getEbcLowerBound()
        );
    }

    /**
     * Test setting a minimum EBC that is too low (less than 2)
     */
    public function testSettingAMinimumEbcThatIsTooLow()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setEbcLowerBound(1);
    }

    /**
     * Test setting a minimum EBC that is too high (greater than 27)
     */
    public function testSettingAMinimumEbcThatIsTooHigh()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setEbcLowerBound(28);
    }

    /**
     * Test setting a minimum EBC with a value that is neither an integer
     * nor a float.
     */
    public function testSettingAMinimumEbcThatIsNotAnIntegerOrAFloat()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setEbcLowerBound("beep boop");
    }

    /**
     * Test setting the maximum EBC and getting the same value back.
     * EBC can range from 2 to 27 (inclusive).
     */
    public function testSettingTheMaximumEbcAndGettingTheSameValueBack()
    {
        $punkApi = new PunkAPI();

        $randomEbc = rand(2, 27);
        $punkApi->setEbcUpperBound($randomEbc);
        $this->assertEquals(
            $randomEbc,
            $punkApi->getEbcUpperBound()
        );
    }

    /**
     * Test setting a maximum EBC that is too low (less than 2)
     */
    public function testSettingAMaximumEbcThatIsTooLow()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setEbcUpperBound(1);
    }

    /**
     * Test setting a maximum EBC that is too high (greater than 27)
     */
    public function testSettingAMaximumEbcThatIsTooHigh()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setEbcUpperBound(28);
    }

    /**
     * Test setting a maximum EBC with a value that is neither an integer
     * nor a float.
     */
    public function testSettingAMaximumEbcThatIsNotAnIntegerOrAFloat()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setEbcLowerBound("wiff waff");
    }

    /**
     * Test setting the beer name in a Punk API object.
     */
    public function testSettingBeerName()
    {
        $punkApi = new PunkAPI();

        $punkApi->setBeer("Zleet's tasty hoppy pilsner");

        // check that the beer name has been set in the PunkAPI object
        $this->assertEquals(
            "Zleet's tasty hoppy pilsner",
            $punkApi->getBeer()
        );
    }

    /**
     * Test setting a beer name that is not a string
     */
    public function testSettingABeerNameThatIsNotAString()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setBeer(365);
    }

    /**
     * Test setting a beer name that is an empty string.
     */
    public function testSettingABeerNameWithAnEmptyString()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setBeer("");
    }

    /**
     * Test setting a yeast that is not a string
     */
    public function testSettingAYeastThatIsNotAString()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setYeast(365);
    }

    /**
     * Test setting a yeast that is an empty string.
     */
    public function testSettingAYeastWithAnEmptyString()
    {
        $punkApi = new PunkAPI();
        $this->expectException(InvalidArgumentException::class);
        $punkApi->setYeast("");
    }

}
