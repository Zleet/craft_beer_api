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
class PunkAPI
{
    private $ABVLowerBound;
    private $ABVUpperBound;
    private $IBULowerBound;
    private $IBUUpperBound;
    private $EBCLowerBound;
    private $EBCUpperBound;
    private $beer;
    private $yeast;
    private $brewedBefore;
    private $brewedAfter;
    private $hops;
    private $malt;
    private $food;
    private $ids;

    public function __construct(
        $ABVLowerBound  = 0,
        $ABVUpperBound  = 100,
        $IBULowerBound  = 0,
        $IBUUpperBound  = 100,
        $EBCLowerBound  = 0,
        $EBCUpperBound  = 100,
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
        $this->ABVLowerBound    = $ABVLowerBound;
        $this->ABVUpperBound    = $ABVUpperBound;
        $this->IBULowerBound    = $IBULowerBound;
        $this->IBUUpperBound    = $IBUUpperBound;
        $this->EBCLowerBound    = $EBCLowerBound;
        $this->EBCUpperBound    = $EBCUpperBound;
        $this->beer             = $beer;
        $this->yeast            = $yeast;
        $this->brewedBefore     = $brewedBefore;
        $this->brewedAfter      = $brewedAfter;
        $this->hops             = $hops;
        $this->malt             = $malt;
        $this->food             = $food;
        $this->ids              = $ids;
    }

    public function setABVLowerBound($lowerBound)
    {
        if ((!is_int($lowerBound)) && (!is_float($lowerBound))) {
            return;
        }

        if ($lowerBound < 0) {
            return;
        }

        $this->ABVLowerbound = $lowerBound;
    }

    public function getABVLowerBound($lowerBound)
    {
        return $this->ABVLowerBound;
    }

    public function setABVUpperBound($upperBound)
    {
        if ((!is_int($upperBound)) && (!is_float($upperBound))) {
            return;
        }

        if ($upperBound > 100) {
            return;
        }

        $this->ABVUpperbound = $upperBound;
    }

    public function getABVUpperBound($upperBound)
    {
        return $this->ABVUpperBound;
    }

    // The IBU scale ranges from 1 to 100
    public function setIBULowerBound($lowerBound)
    {
        if ((!is_int($lowerBound)) && (!is_float($lowerBound))) {
            return;
        }

        if ($lowerBound < 1) {
            return;
        }

        $this->IBULowerbound = $lowerBound;
    }

    public function getIBULowerBound($lowerBound)
    {
        return $this->IBULowerBound;
    }

    public function setIBUUpperBound($upperBound)
    {
        if ((!is_int($upperBound)) && (!is_float($upperBound))) {
            return;
        }

        if ($upperBound > 100) {
            return;
        }

        $this->IBUUpperbound = $upperBound;
    }

    public function getIBUUpperBound($upperBound)
    {
        return $this->IBUUpperBound;
    }

    // The EBC scale ranges from 2 to 27
    public function setEBCLowerBound($lowerBound)
    {
        if ((!is_int($lowerBound)) && (!is_float($lowerBound))) {
            return;
        }

        if ($lowerBound < 2) {
            return;
        }

        $this->EBCLowerbound = $lowerBound;
    }

    public function getEBCLowerBound($lowerBound)
    {
        return $this->EBCLowerBound;
    }

    public function setEBCUpperBound($upperBound)
    {
        if ((!is_int($upperBound)) && (!is_float($upperBound))) {
            return;
        }

        if ($upperBound > 27) {
            return;
        }

        $this->EBCUpperbound = $upperBound;
    }

    public function getEBCUpperBound($upperBound)
    {
        return $this->EBCUpperBound;
    }

    public function setBeer($beer)
    {
        if (!is_string($beer)) {
            return;
        }

        $this->beer = $beer;
    }

    public function getBeer($beer)
    {
        return $this->beer;
    }

    public function setYeast($yeast)
    {
        if (!is_string($yeast)) {
            return;
        }

        $this->yeast = $yeast;
    }

    public function getYeast($yeast)
    {
        return $this->yeast;
    }

    public function setBrewedBefore($brewedBefore)
    {
        // if (!isValidBrewDateBound($brewedBefore)) {
        //     return;
        // }
        $date = DateTime::createFromFormat('m-Y', $brewedBefore);
        if ($date === false) {
            return;
        }

        $this->brewedBefore = $brewedBefore;
    }

    public function getBrewedBefore($brewedBefore)
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

    public function getBrewedAfter($brewedAfter)
    {
        return $this->brewedAfter;
    }

    public function setHops($hops)
    {
        // code here    
        // bookmark (8/1/21 at 1202)
    }

    public function getHops($hops)
    {
        // code here
    }

    public function setMalt($malt)
    {
        // code here    
    }

    public function getMalt($malt)
    {
        // code here
    }

    public function setFood($food)
    {
        // code here    
    }

    public function getFood($food)
    {
        // code here
    }

    public function setIDs($ids)
    {
        // code here    
    }

    public function getIDs($ids)
    {
        // code here
    }

    // Helper function to validate that a date supplied for a brew date upper
    // or lower bound is in the format MM-YYYY.
    // If the date string is valid, return 1, otherwise return 0.
    // private isValidBrewDateBound($dateString)
    // {
    //     // check that the third character in date string is a dash
    //     if (strpos($dateString, '-') != 2) {
    //         return 0;
    //     }

    //     // check that date string only contains dashes and digits
    //     if (!stringContainsOnlyWhitelistCharacters(
    //         $dateString,
    //         '-0123456789')
    //     ) {
    //         return 0;
    //     }

    //     // split date string along dash
    //     $dateElements = explode('-', $dateString);
    //     $month = $dateElements[0];
    //     $year = $dateElements[1];

    //     // check that first element contains two characters AND consists solely
    //     // of digits
    //     if ((strlen($month) != 2)
    //         || (!stringContainsOnlyWhitelistCharacters($month, '0123456789')) {
    //         return 0;
    //     }

    //     // check that second element contains four characters AND is an integer

    //     // if we've fallen through, date string is valid
    //     return 1;
    // }

    // Helper function to check that a string consists entirely of characters
    // supplied in a whitelist string
    private stringContainsOnlyWhitelistCharacters(
        $stringToCheck,
        $whitelistString
    ) {
        // loop through all the characters in $stringToCheck and check that
        // they're all in $whitelistString
        $totalCharacters = strlen($stringToCheck);
        for ($i = 0; $i < $totalCharacters; ++$i) {
            $currentCharacter = substr($stringToCheck, $i, 1);
            if (strpos($whitelistString, $currentCharacter) === false) {
                return 0;
            }
        }
        // if we've fallen through, all the characters in $stringToCheck have
        // been found in $whitelistString
        return 1;
    }

}
// ============================================================================
// ============================================================================
// ============================================================================
// ============================================================================
// ============================================================================
