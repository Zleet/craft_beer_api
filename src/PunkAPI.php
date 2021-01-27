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
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
//use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use http\Exception\InvalidArgumentException;

class PunkAPI
{
    private $client = null;
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
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        if (is_null($this->client)) {
            $this->client = new Client([
                'base_uri' => 'https://api.punkapi.com/v2/beers/',
                'timeout' => '5'
            ]);
        }
    }

    /**
     * Set the ABV lower bound. (ABV can range from 0 to 100)
     *
     * @param int $lowerBound
     */
    public function setAbvLowerBound($lowerBound)
    {
        if ((!is_int($lowerBound)) && (!is_float($lowerBound))) {
            throw new \InvalidArgumentException(
                "The ABV lower bound must be an integer or a float."
            );
        }

        if (($lowerBound < 0) || ($lowerBound > 100)) {
            throw new \InvalidArgumentException(
                "The ABV lower bound must be between zero and 100 "
                . "(inclusive)"
            );
        }

        $this->abvLowerBound = $lowerBound;
    }

    /**
     * @return mixed
     */
    public function getAbvLowerBound()
    {
        return $this->abvLowerBound;
    }

    /**
     * @param $upperBound
     */
    public function setAbvUpperBound($upperBound)
    {
        if ((!is_int($upperBound)) && (!is_float($upperBound))) {
            throw new \InvalidArgumentException(
                "The ABV upper bound must be an integer or a float."
            );
        }

        if (($upperBound < 0) || ($upperBound > 100)) {
            throw new \InvalidArgumentException(
                "The ABV upper bound must be between zero and 100 (inclusive)."
            );
        }

        $this->abvUpperBound = $upperBound;
    }

    /**
     * @return mixed
     */
    public function getAbvUpperBound()
    {
        return $this->abvUpperBound;
    }

    /**
     * Set the IBU lower bound. (IBU can range from 1 to 100).
     *
     * @param $lowerBound
     */
    public function setIbuLowerBound($lowerBound)
    {
        if ((!is_int($lowerBound)) && (!is_float($lowerBound))) {
            throw new \InvalidArgumentException(
                "IBU lower bound must be either an integer or a float."
            );
        }

        if (($lowerBound < 1) || ($lowerBound > 100)) {
            throw new \InvalidArgumentException(
                "IBU lower bound must be a value between 1 and 100 (inclusive)."
            );
        }

        $this->ibuLowerBound = $lowerBound;
    }

    /**
     * @return mixed
     */
    public function getIbuLowerBound()
    {
        return $this->ibuLowerBound;
    }

    /**
     * Set the maximum IBU (which can range from 1 to 100 inclusive).
     * @param $upperBound
     */
    public function setIbuUpperBound($upperBound)
    {
        if ((!is_int($upperBound)) && (!is_float($upperBound))) {
            throw new \InvalidArgumentException(
                "IBU upper bound must be either an integer or a float."
            );
        }

        if (($upperBound < 1) || ($upperBound > 100)) {
            throw new \InvalidArgumentException(
                "IBU upper bound must lie between 1 to 100 (inclusive)."
            );
        }

        $this->ibuUpperBound = $upperBound;
    }

    /**
     * @return mixed
     */
    public function getIbuUpperBound()
    {
        return $this->ibuUpperBound;
    }

    /**
     * Set the minimum EBC. The EBC scale ranges from 2 to 27 (inclusive)
     *
     * @param $lowerBound
     */
    public function setEbcLowerBound($lowerBound)
    {
        if ((!is_int($lowerBound)) && (!is_float($lowerBound))) {
            throw new \InvalidArgumentException(
                "Minimum EBC must be either an integer or a float.");
        }

        if (($lowerBound < 2) || ($lowerBound > 27)) {
            throw new \InvalidArgumentException(
                "Minimum EBC must be between 2 and 27 (inclusive).");
        }

        $this->ebcLowerBound = $lowerBound;
    }

    /**
     * @return mixed
     */
    public function getEbcLowerBound()
    {
        return $this->ebcLowerBound;
    }

    /**
     * @param $upperBound
     */
    public function setEbcUpperBound($upperBound)
    {
        if ((!is_int($upperBound)) && (!is_float($upperBound))) {
            throw new \InvalidArgumentException(
                "Maximum EBC must be either an integer or a float.");
        }

        if (($upperBound < 2) || ($upperBound > 27)) {
            throw new \InvalidArgumentException(
                "Maximum EBC must be between 2 and 27 (inclusive).");
        }

        $this->ebcUpperBound = $upperBound;
    }

    /**
     * @return mixed
     */
    public function getEbcUpperBound()
    {
        return $this->ebcUpperBound;
    }

    /**
     * @param string $beer
     */
    public function setBeer($beer)
    {
        if (!is_string($beer)) {
            throw new \InvalidArgumentException(
                "Beer name must be a string.");
        }

        if (strlen($beer) === 0) {
            throw new \InvalidArgumentException(
                "Beer name must be a non-empty string."
            );
        }

        $this->beer = $beer;
    }

    /**
     * @return mixed
     */
    public function getBeer()
    {
        return $this->beer;
    }

    /**
     * @param string $yeast
     */
    public function setYeast(string $yeast)
    {
        if (!is_string($yeast)) {
            return;
        }

        $this->yeast = $yeast;
    }

    /**
     * @return mixed
     */
    public function getYeast()
    {
        return $this->yeast;
    }

    /**
     * @param string $brewedBefore
     */
    public function setBrewedBefore(string $brewedBefore)
    {
        if (preg_match('/[0-9]{2}-[0-9]{4}/', $brewedBefore)) {
            $this->brewedBefore = $brewedBefore;
        }
    }

    /**
     * @return mixed
     */
    public function getBrewedBefore()
    {
        return $this->brewedBefore;
    }

    /**
     * @param $brewedAfter
     */
    public function setBrewedAfter($brewedAfter)
    {
        if (preg_match('/[0-9]{2}-[0-9]{4}/', $brewedAfter)) {
            $this->brewedAfter = $brewedAfter;
        }
    }

    /**
     * @return mixed
     */
    public function getBrewedAfter()
    {
        return $this->brewedAfter;
    }

    /**
     * @param $hops
     */
    public function setHops($hops)
    {
        if (is_string($hops)) {
            $this->hops = $hops;
        }
    }

    /**
     * @return mixed
     */
    public function getHops()
    {
        return $this->hops;
    }

    /**
     * @param $malt
     */
    public function setMalt($malt)
    {
        if (is_string($malt)) {
            $this->malt = $malt;
        }
    }

    /**
     * @return mixed
     */
    public function getMalt()
    {
        return $this->malt;
    }

    /**
     * @param $food
     */
    public function setFood($food)
    {
        if (is_string($food)) {
            $this->food = $food;
        }
    }

    /**
     * @return mixed
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * @param $ids
     */
    public function setIds($ids)
    {
        if ($this->containsOnlyWhitelistCharacters($ids, '0123456789 |')) {
            $this->ids = $ids;
        }
    }

    /**
     * @return mixed
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param $id
     * @return Beer
     * @throws GuzzleException
     */
    public function single($id): Beer
    {
        $response = $this->client->get(strval($id));

        switch ($response->getStatusCode()) {
            case 200:
                $responseBody = $response->getBody();
                $beerInfo = json_decode($responseBody, 1)[0];
                return Beer::fromArray($beerInfo);
            case 400:
                throw new ClientException("404 Beer not found");
            default:
                throw new ClientException("There was an error");
        }
    }

    /**
     * get a single beer and return the information for it in array format
     *
     * @param int $id the id of the beer we're looking up in the Punk API
     *
     * @return array
     */
    public function singleAsArray($id)
    {

        // get the beer info
        $response = $this->client->request(
            'GET',
            'https://api.punkapi.com/v2/beers/' . strval($id));

        // get the response code
        $responseStatusCode = $response->getStatusCode();

        // if we've got a 200 OK response, build a Beer object from the
        // decoded JSON data in the response body
        if ($responseStatusCode == 200) {
            // decode the JSON in the response body
            $responseBody = $response->getBody();
            $beerInfo = json_decode($responseBody, 1)[0];
            return $beerInfo;
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
    public function random()
    {

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
    public function all()
    {

        // Build an array containing all the parameters for querying the
        // Punk API. This will be passed into the API query when we attempt
        // to retrieve a bunch of beers.
        $paramsAndValues = [
            "abv_gt" => $this->abvLowerBound,
            "abv_lt" => $this->abvUpperBound,
            "ibu_gt" => $this->ibuLowerBound,
            "ibu_lt" => $this->ibuUpperBound,
            "ebc_gt" => $this->ebcLowerBound,
            "ebc_lt" => $this->ebcUpperBound,
            "beer_name" => $this->beer,
            "yeast" => $this->yeast,
            "brewed_before" => $this->brewedBefore,
            "brewed_after" => $this->brewedAfter,
            "hops" => $this->hops,
            "malt" => $this->malt,
            "food" => $this->food,
            "ids" => $this->ids
        ];

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
            foreach ($beersInfo as $singleBeerInfo) {
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
    private function readSingleBeerInfoFromLocalFile()
    {

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
    private function fetchSingleBeerInfoFromPunkApi($id)
    {

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
}
