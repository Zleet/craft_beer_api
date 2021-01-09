<?php
// ============================================================================
// Punk API (Craft Beer API)
// https://punkapi.com/documentation/v2
//
// Wikipedia article on beer measurement:
// https://en.wikipedia.org/wiki/Beer_measurement
// (Explains some of the terms used below (e.g. 'IBU', 'EBC' etc.))
//
// IBU - International Bitterness Units
//       (used to quantify the bitterness of beer)
// EBC - A measure of the colour of the beer, by comparing it to a series of
//       amber to brown glass slides
// ============================================================================
namespace Zleet\PunkAPI;
// ============================================================================
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
        $date = DateTime::createFromFormat('m-Y', $brewedBefore);
        if ($date === false) {
            return;
        }

        $this->brewedBefore = $brewedBefore;
    }

    public function getBrewedBefore()
    {
        return $this->brewedBefore;
    }

    public function setBrewedAfter($brewedAfter)
    {
        $date = DateTime::createFromFormat('m-Y', $brewedAfter);
        if ($date === false) {
            return;
        }

        $this->brewedAfter = $brewedAfter;
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
        // code here    
    }

    public function getMalt()
    {
        return $this->malt;
    }

    public function setFood($food)
    {
        // code here    
    }

    public function getFood()
    {
        return $this->food;
    }

    public function setIDs($ids)
    {
        // code here    
    }

    public function getIDs()
    {
        return $this->ids;
    }

    // Testing helper function to save us from hitting an API endpoint every
    // time we want to test. It reads a sample JSON API response from a local
    // file, decodes it and returns it as an associative array.
    private function readJSONSampleFromLocalFile() {

        $jsonDemoReply = file_get_contents(
            "JSON_sample_reply_for_testing.json");

        return jsonDemoReply;
    }

    // get a single beer
    public function single($id) {

        // use the test JSON rather than hit the API endpoint
        $jsonReply = $this->readJSONSampleFromLocalFile();

        return $jsonReply;
    }



}
// ============================================================================
// ============================================================================
// ============================================================================
// ============================================================================
// ============================================================================
