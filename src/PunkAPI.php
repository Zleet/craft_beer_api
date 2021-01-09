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

class PunkAPI
{
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

    public function __construct(
        $abvLowerBound  = 0,
        $abvUpperBound  = 100,
        $ibuLowerBound  = 0,
        $ibuUpperBound  = 100,
        $ebcLowerBound  = 2,
        $ebcUpperBound  = 27,
        $beer           = '',
        $yeast          = '',
        $brewedBefore   = '12-2100',    // mm-yyyy (e.g. '10-2011')
        $brewedAfter    = '01-1900',    // mm-yyyy (e.g. '10-2011')
        $hops           = '',
        $malt           = '',
        $food           = '',
        $ids            = ''
    ) {
        // initialise all the properties for the new PunkAPI object
        $this->abvLowerBound    = $abvLowerBound;
        $this->abvUpperBound    = $abvUpperBound;
        $this->ibuLowerBound    = $ibuLowerBound;
        $this->ibuUpperBound    = $ibuUpperBound;
        $this->ebcLowerBound    = $ebcLowerBound;
        $this->ebcUpperBound    = $ebcUpperBound;
        $this->beer             = $beer;
        $this->yeast            = $yeast;
        $this->brewedBefore     = $brewedBefore;
        $this->brewedAfter      = $brewedAfter;
        $this->hops             = $hops;
        $this->malt             = $malt;
        $this->food             = $food;
        $this->ids              = $ids;
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

        // used for testing to avoid hitting API endpoint every time
        // (comment out when we switch to actually accessing the endpoint)
        // $jsonResponse = $this->readSingleBeerInfoFromLocalFile();

        // code for actually retrieving the single beer information from
        // the endpoint goes here (call another helper function)
        $jsonResponse = $this->fetchSingleBeerInfoFromPunkApi($id);

        return $jsonResponse;
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

}
