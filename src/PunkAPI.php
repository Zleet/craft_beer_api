<?php

/**
 * A class for accessing the Punk API (Craft Beer API)
 *
 * Use this class to retrieve information from the Punk API by Brewdog
 *
 * Documentation here:
 * https://punkapi.com/documentation/v2
 *
 * Wikipedia article on beer measurement:
 * https://en.wikipedia.org/wiki/Beer_measurement
 * (Explains some of the terms used below (e.g. 'IBU', 'EBC' etc.))
 *
 * Some (perhaps less well known) units used when accessing the Punk API:
 * IBU - International Bitterness Units
 *       (used to quantify the bitterness of beer)
 * EBC - A measure of the colour of the beer, by comparing it to a series of
 *       amber to brown glass slides
 */

namespace Zleet\PunkAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class PunkAPI
{
    private $client;
    private $abvLowerBound;
    private $abvUpperBound;
    private $ibuLowerBound;
    private $ibuUpperBound;
    private $ebcLowerBound;
    private $ebcUpperBound;
    private $beer;
    private $yeast;
    private $brewedBefore;
    private $brewedAfter;
    private $hops;
    private $malt;
    private $food;
    private $ids;

    /**
     * PunkAPI constructor.
     *
     * @param int    $abvLowerBound
     * @param int    $abvUpperBound
     * @param int    $ibuLowerBound
     * @param int    $ibuUpperBound
     * @param int    $ebcLowerBound
     * @param int    $ebcUpperBound
     * @param string $beer
     * @param string $yeast
     * @param string $brewedBefore
     * @param string $brewedAfter
     * @param string $hops
     * @param string $malt
     * @param string $food
     * @param string $ids
     * @param Client $client        a GuzzleHttp\client object
     */
    public function __construct(
        Client $client  = null
    ) {
        // if a GuzzleHttp\Client hasn't been passed into the PunkAPI
        // constructor, create a Client object that will make real requests
        // to the Punk API
        if (is_null($this->client)) {
            $this->client = new Client(
                 [
                     'base_url' => 'https://api.punkapi.com/v2/beers/',
                    'timeout'   => '5'
                 ]
            );
        }
    }

    // ABV can range from 0 to 100
    public function setAbvLowerBound($lowerBound)
    {
        if ((!is_int($lowerBound)) && (!is_float($lowerBound))) {
            return;
        }

        if ($lowerBound < 0) {
            return;
        }

        $this->AbvLowerbound = $lowerBound;
    }

    public function getAbvLowerBound()
    {
        return $this->abvLowerBound;
    }

    public function setAbvUpperBound($upperBound)
    {
        if ((!is_int($upperBound)) && (!is_float($upperBound))) {
            return;
        }

        if ($upperBound > 100) {
            return;
        }

        $this->abvUpperbound = $upperBound;
    }

    public function getAbvUpperBound()
    {
        return $this->abvUpperBound;
    }

    // The IBU scale ranges from 1 to 100
    public function setIbuLowerBound($lowerBound)
    {
        if ((!is_int($lowerBound)) && (!is_float($lowerBound))) {
            return;
        }

        if ($lowerBound < 1) {
            return;
        }

        $this->ibuLowerbound = $lowerBound;
    }

    public function getIbuLowerBound()
    {
        return $this->ibuLowerBound;
    }

    public function setIbuUpperBound($upperBound)
    {
        if ((!is_int($upperBound)) && (!is_float($upperBound))) {
            return;
        }

        if ($upperBound > 100) {
            return;
        }

        $this->ibuUpperbound = $upperBound;
    }

    public function getIbuUpperBound()
    {
        return $this->ibuUpperBound;
    }

    // The EBC scale ranges from 2 to 27
    public function setEbcLowerBound($lowerBound)
    {
        if ((!is_int($lowerBound)) && (!is_float($lowerBound))) {
            return;
        }

        if (($lowerBound < 2) || ($lowerBound > 27)) {
            return;
        }

        $this->ebcLowerbound = $lowerBound;
    }

    public function getEbcLowerBound()
    {
        return $this->ebcLowerBound;
    }

    public function setEbcUpperBound($upperBound)
    {
        if ((!is_int($upperBound)) && (!is_float($upperBound))) {
            return;
        }

        if (($upperBound > 27) || ($upperBound < 2)) {
            return;
        }

        $this->ebcUpperbound = $upperBound;
    }

    public function getEbcUpperBound()
    {
        return $this->ebcUpperBound;
    }

    public function setBeer(string $beer)
    {
        if (!is_string($beer)) {
            return;
        }

        $this->beer = $beer;
    }

    public function getBeer()
    {
        return $this->beer;
    }

    public function setYeast(string $yeast)
    {
        if (!is_string($yeast)) {
            return;
        }

        $this->yeast = $yeast;
    }

    public function getYeast()
    {
        return $this->yeast;
    }

    public function setBrewedBefore(string $brewedBefore)
    {
        if (preg_match('/[0-9]{2}-[0-9]{4}/', $brewedBefore)) {
            $this->brewedBefore = $brewedBefore;
        }
    }

    public function getBrewedBefore()
    {
        return $this->brewedBefore;
    }

    public function setBrewedAfter($brewedAfter)
    {
        if (preg_match('/[0-9]{2}-[0-9]{4}/', $brewedAfter)) {
            $this->brewedAfter = $brewedAfter;
        }
    }

    public function getBrewedAfter()
    {
        return $this->brewedAfter;
    }

    public function setHops($hops)
    {
        if (is_string($hops)) {
            $this->hops = $hops;
        }
    }

    public function getHops()
    {
        return $this->hops;
    }

    public function setMalt($malt)
    {
        if (is_string($malt)) {
            $this->malt = $malt;
        }
    }

    public function getMalt()
    {
        return $this->malt;
    }

    public function setFood($food)
    {
        if (is_string($food)) {
            $this->food = $food;
        }
    }

    public function getFood()
    {
        return $this->food;
    }

    public function setIds($ids)
    {
        // why is this regex not working???
        // if (preg_match('/[0123456789 |]*/', $ids)) {
        //     $this->ids = $ids;
        // }

        if ($this->containsOnlyWhitelistCharacters($ids, '0123456789 |')) {
            $this->ids = $ids;
        }
    }

    public function getIds()
    {
        return $this->ids;
    }

    // get a single beer
    public function single($id) {

        // get the beer info
        $response = $this->client->request(
            'GET',
            'https://api.punkapi.com/v2/beers/' . strval($id));

        // get the response code
        $responseStatusCode = $response->getStatusCode();

        // test print the response status code
        echo "\nResponse status code:\n" . $responseStatusCode;

        // if we've got a 200 OK response, build a Beer object from the
        // decoded JSON data in the response body
        if ($responseStatusCode == 200) {
            // decode the JSON in the response body
            $responseBody = $response->getBody();
            // build a Beer object from the JSON and return it
            $beerInfo = json_decode($responseBody, 1)[0];
            $beer = Beer::fromArray($beerInfo);
            return $beer;
        }

        // handle a 404 beer not found response
        if ($responseStatusCode == 404) {
            throw new ClientException("404 Beer not found");
        }

        // TODO: handle other response codes here

        return;
    }

    /**
     * Get a random beer.
     */
    public function random() {

        // get the beer info
        $response = $this->client->request(
            'GET',
            'https://api.punkapi.com/v2/beers/random'
        );

        // get the response code
        $responseStatusCode = $response->getStatusCode();

        // if we've got a 200 OK response, build a Beer object from the
        // decoded JSON data in the response body
        if ($responseStatusCode == 200) {
            // decode the JSON in the response body
            $responseBody = $response->getBody();
            // build a Beer object from the JSON and return it
            $beerInfo = json_decode($responseBody, 1)[0];
            $beer = Beer::fromArray($beerInfo);
            return $beer;
        }

        // TODO: handle other response types here (e.g. 404 Not Found etc)

        return;
    }

    /**
     * Get all the beers, using parameters set in the properties of the
     * PunkAPI object
     */
    public function all() {

//        // build the parameter string, which will go at the end of the url
//        $params = '';
//
//        // we're going to build an array of strings, each one of which is
//        // is composed of a parameter and a value, joined by an equals sign
//        // e.g. 'abv-gt=6' etc.
//        // Later, we're going to implode these along ampersands to build the
//        // final url
//        $parameterAndValueStrings = [];
//
//        // get all the variables of the current object and test print them
//        $objectVariables = get_object_vars($this);
//
//        // loop through numeric properties and add them to the url parameters
//        $numericPropertiesAndUrlParams = [
//            "abvLowerBound" => "abv_gt",
//            "abvUpperBound" => "abv_lt",
//            "ibuLowerBound" => "ibu_gt",
//            "ibuUpperBound" => "ibu_lt",
//            "ebcLowerBound" => "ebc_gt",
//            "ebcUpperBound" => "ebc_lt"
//        ];
//        foreach ($numericPropertiesAndUrlParams as $propertyName => $urlParam) {
//            $parameterAndValue = $urlParam . '=';
//            $parameterAndValue .= $objectVariables[$propertyName];
//            $parameterAndValueStrings[] = $parameterAndValue;
//        }
//
//        // loop through string properties. Only add a string property to the
//        // url parameters if it's not an empty string
//        $stringPropertiesAndUrlParams = [
//            "beer"  => "beer_name",
//            "yeast" => "yeast",
//            "hops"  => "hops",
//            "malt"  => "malt",
//            "food"  => "food",
//            "ids"   => "ids"
//        ];
//        foreach ($stringPropertiesAndUrlParams as $propertyName => $urlParam) {
//            if (strlen($objectVariables[$propertyName]) > 0) {
//                // get property value and replace spaces with underscores
//                $propertyValue = $objectVariables[$propertyName];
//                $propertyValue = str_replace(' ', '_',
//                    $propertyValue);
//                $parameterAndValue = $urlParam . '=';
//                $parameterAndValue .= $propertyValue;
//                $parameterAndValueStrings[] = $parameterAndValue;
//            }
//        }

        // Build an array containing all the parameters for querying the
        // Punk API. This will be passed into the API query when we attempt
        // to retrieve a bunch of beers.
        $paramsAndValues = [
            "abv_gt"        => $this->abvLowerBound,
            "abv_lt"        => $this->abvUpperBound,
            "ibu_gt"        => $this->ibuLowerBound,
            "ibu_lt"        => $this->ibuUpperBound,
            "ebc_gt"        => $this->ebcLowerBound,
            "ebc_lt"        => $this->ebcUpperBound,
            "beer_name"     => $this->beer,
            "yeast"         => $this->yeast,
            "brewed_before" => $this->brewedBefore,
            "brewed_after"  => $this->brewedAfter,
            "hops"          => $this->hops,
            "malt"          => $this->malt,
            "food"          => $this->food,
            "ids"           => $this->ids
                            ];

        // prepend the url for the Punk API
        // $url = 'https://api.punkapi.com/v2/beers';
        // $url .= implode('&', $parameterAndValueStrings);

        // get the data from the Punk API
        $client = new Client();
        $response = $client->request(
            'GET',
            'https://api.punkapi.com/v2/beers',
            [
                'query' => $paramsAndValues
            ]
        );

        $responseStatusCode = $response->getStatusCode();

        // If we've got a 200 OK response from the API:
        // 1. decode the JSON in the body of the response
        // 2. loop through the subarrays in the decoded JSON. For each
        //    subarray, build a Beer object.
        // 3. return an array containing all the Beer objects
        if ($responseStatusCode == 200) {
            $beersInfo = json_decode($response->getBody(), 1);
            // test print
            // echo "\n\nbeersInfo:\n:";
            // print_r($beersInfo);
            $arrayOfBeerObjects = [];
            foreach($beersInfo as $singleBeerInfo) {
                $beerObject = Beer::fromArray($singleBeerInfo);
                $arrayOfBeerObjects[] = $beerObject;
            }
            // use the array of Beer objects to create a new BeerCollection
            // object
            $collectionOfBeers = new BeerCollection($arrayOfBeerObjects);

            return $collectionOfBeers;
        }

        // TODO: handle other API responses here

        return;
    }

    /**
     * Testing helper function to save us from hitting an API endpoint every
     * time we want to test. It reads a sample JSON API response from a local
     * file, decodes it and returns it as an associative array.
     */
    private function readSingleBeerInfoFromLocalFile() {

        // get all the elements in the current directory
        $dirElements = explode('/', __DIR__);

        // remove the final directory from the list of folders and replace it
        // with 'tests'
        array_pop($dirElements);

        // append the 'tests' directory to the list of folders
        $dirElements[] = 'tests';

        // implode the folders along slashes
        $filePath = implode('/', $dirElements);

        // append the name of the local JSON file
        $jsonFilename = $filePath . "/JSON_sample_reply_for_testing.json";

        $singleBeerJSON = file_get_contents($jsonFilename);
        $singleBeerInfo = json_decode($singleBeerJSON, 1);
        $singleBeerInfo = $singleBeerInfo[0];

        return $singleBeerInfo;
    }

    /**
     * Helper function to fetch the information for a single beer using the
     * Punk API
     */
    private function fetchSingleBeerInfoFromPunkApi($id) {

        $client = new Client();

        // build the url for the request
        $url = 'https://api.punkapi.com/v2/beers/' . $id;

        // fetch the info for the beer with id $id
        $response = $client->request('GET', $url);

        $singleBeerInfo = json_decode($response->getBody(), true);
        $singleBeerInfo = $singleBeerInfo[0];

        return $singleBeerInfo;
    }

    /**
     * Check that $testString consists solely of characters that can be found in
     * the string $whitelist. If this is so, return 1, otherwise return 0.
     */
    private function containsOnlyWhitelistCharacters($testString, $whitelist)
    {
        $totalCharacters = strlen($testString);
        for ($i = 0; $i < $totalCharacters; ++$i) {
            $currentCharacter = substr($testString, $i, 1);
            if (strpos('_' . $whitelist, $currentCharacter) === false) {
                return 0;
            }
        }

        // if we've fallen through, all of the characters in $testString can be
        // found in the string $whiteList
        return 1;
    }

    //

}
