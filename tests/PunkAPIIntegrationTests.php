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
class PunkAPIIntegrationTests extends \PHPUnit\Framework\TestCase
{
    /**
     * Test getting the information for a single beer using the actual Punk API
     */
    public function testGettingSingleBeerInformationUsingActualAPI()
    {
        // create a new PunkAPI object. Don't pass in a custom handle with
        // mocks for API replies. By omitting the handle parameters, we'll
        // ensure that the PunkAPI object actually contacts the Punk API
        // for the beer information
        $punkAPI = new PunkAPI();

        // attempt to retrieve the information for the beer with id 5
        // (should return a Beer object)
        $beer = $punkAPI->single(5);

        // check that we've got a beer object back
        $this->assertInstanceOf(
            Beer::class,
            $beer,
            "PunkAPI->single() didn't return a Beer object."
        );
    }

    /**
     * Test getting the information for a random beer using the actual
     * Punk API
     */
    public function testGettingARandomBeerUsingTheActualApi()
    {
        $this->pauseBetweenApiRequests(2);

        // create a new PunkAPI object. Don't pass in a client object to
        // the constructor (we're going to contact the actual Punk API
        // online to get the random beer information)
        $punkAPI = new PunkAPI();

        // retrieve the information for a random beer
        $beer = $punkAPI->random();

        // check that we've got a beer object back
        $this->assertInstanceOf(
            Beer::class,
            $beer,
            "PunkAPI->random() didn't return a Beer object."
        );
    }

    /**
     * Test getting all the beers using the actual Punk API
     */
    public function testGettingAllTheBeersUsingTheActualApi()
    {
        $this->pauseBetweenApiRequests(2);

        $punkAPI = new PunkAPI();

        // attempt to retrieve the information for several beers
        // (in an array of Beer objects)
        $bunchOfBeers = $punkAPI->all();

        // loop through all the elements in the array $bunchOfBeers and check
        // that they're all Beer objects
        foreach ($bunchOfBeers as $beer) {
            $this->assertInstanceOf(
                Beer::class,
                $beer,
                "After contacting the actual Punk API, in the"
                . " array returned by PunkAPI->all(), not all elements"
                . " are Beer objects."
            );
        }
    }

    /**
     * Test getting a collection of Beers from the actual Punk API
     * whose ABV lies within a specified range
     */
    public function testGettingBeersWithAbvInASpecificRange()
    {
        $this->pauseBetweenApiRequests(2);

        $abvMinimum = 3.0;
        $abvMaximum = 4.0;

        $punkAPI = new PunkAPI();

        // set ABV lower and upper bounds
        $punkAPI->setAbvLowerBound($abvMinimum);
        $punkAPI->setAbvUpperBound($abvMaximum);

        // get the beers
        $bunchOfBeers = $punkAPI->all();

        // loop through the beers and, for each beer, check that its abv
        // lies in the range [$abvMinimum, $abvMaximum] inclusive
        foreach ($bunchOfBeers as $beer) {
            $this->assertGreaterThanOrEqual(
                $abvMinimum,
                $beer->getAbv(),
                "Beer abv should be greater than or equal to "
                . $abvMinimum . ". Instead, it is " . $beer->getAbv()
            );
            $this->assertLessThanOrEqual(
                $abvMaximum,
                $beer->getAbv(),
                "Beer abv should be less than or equal to "
                . $abvMaximum . ". Instead, it is " . $beer->getAbv()
            );
        }
    }

    /**
     * Test getting a collection of Beers from the actual Punk API
     * whose IBU lies within a specified range
     */
    public function testGettingBeersWithIbuInASpecificRange()
    {
        $this->pauseBetweenApiRequests(2);

        $ibuMinimum = 30;
        $ibuMaximum = 40;

        $punkAPI = new PunkAPI();

        // set IBU lower and upper bounds
        $punkAPI->setIbuLowerBound($ibuMinimum);
        $punkAPI->setIbuUpperBound($ibuMaximum);

        // get the beers
        $bunchOfBeers = $punkAPI->all();

        // loop through the beers and, for each beer, check that its ibu
        // lies in the range [$ibuMinimum, $ibuMaximum] inclusive
        foreach ($bunchOfBeers as $beer) {
            $this->assertGreaterThanOrEqual(
                $ibuMinimum,
                $beer->getIbu(),
                "Beer ibu should be greater than or equal to "
                . $ibuMinimum . ". Instead, it is " . $beer->getIbu()
            );
            $this->assertLessThanOrEqual(
                $ibuMaximum,
                $beer->getIbu(),
                "Beer ibu should be less than or equal to "
                . $ibuMaximum . ". Instead, it is " . $beer->getIbu()
            );
        }
    }

    /**
     * Test getting a collection of Beers from the actual Punk API
     * whose EBC lies within a specified range
     */
    public function testGettingBeersWithEbcInASpecificRange()
    {
        $this->pauseBetweenApiRequests(2);

        $ebcMinimum = 15;
        $ebcMaximum = 23;

        $punkAPI = new PunkAPI();

        // set EBC lower and upper bounds
        $punkAPI->setEbcLowerBound($ebcMinimum);
        $punkAPI->setEbcUpperBound($ebcMaximum);

        // get the beers
        $bunchOfBeers = $punkAPI->all();

        // loop through the beers and, for each beer, check that its ebc
        // lies in the range [$ebcMinimum, $ebcMaximum] inclusive
        foreach ($bunchOfBeers as $beer) {
            $this->assertGreaterThanOrEqual(
                $ebcMinimum,
                $beer->getEbc(),
                "Beer ebc should be greater than or equal to "
                . $ebcMinimum . ". Instead, it is " . $beer->getEbc()
            );
            $this->assertLessThanOrEqual(
                $ebcMaximum,
                $beer->getEbc(),
                "Beer ebc should be less than or equal to "
                . $ebcMaximum . ". Instead, it is " . $beer->getEbc()
            );
        }
    }

//    /**
//     * Test getting a bunch of beers with the substring 'lager' in their name.
//     */
//    public function testGettingBeersWithASpecificName()
//    {
//        $this->pauseBetweenApiRequests(2);
//
//        $punkAPI = new PunkAPI();
//
//        $beerSearchSubstring = "pilsner";
//
//        // set beer name
//        $punkAPI->setBeer($beerSearchSubstring);
//
//        // get the beers
//        $bunchOfBeers = $punkAPI->all();
//
//        // test print all the beer names
//        foreach ($bunchOfBeers as $beer) {
//            echo "\nCurrent beer name = " . $beer->getName();
//        }
//        // loop through the Beer objects and check that each beer name contains
//        // the substring 'lager'
//        foreach ($bunchOfBeers as $beer) {
//            // test print the current beer name
//            echo "\nCurrent beer name:\n" . $beer->getName();
//            $this->assertStringContainsStringIgnoringCase(
//                $beerSearchSubstring,
//                $beer->getName(),
//                "Attempting to retrieve beers with the substring"
//                . $beerSearchSubstring . " in their name is unsuccessful."
//            );
//        }
//    }

    /**
     * Test getting a bunch of beers with a yeast containing "American Ale"
     * in their yeast name.
     */
    public function testGettingBeersWithASpecificYeast()
    {
        $punkApi = new PunkAPI();

        $punkApi->setYeast("American_Ale");

        // get the beers
        $beers = $punkApi->all();

        // loop through the beers and check that the yeast for each beer
        // contains the substring "American Ale"
        foreach ($beers as $beer) {
            $this->assertStringContainsStringIgnoringCase(
                'American Ale',
                $beer->getIngredients()->getYeast(),
                "Beer->getYeast() doesn't return a yeast"
                . " containing the substring 'American Ale'."
            );
        }
    }

    /**
     * Test retrieving beer information for beers in a specific date range.
     */
    public function testGettingBeersBrewedWithASpecificDateRange()
    {
        // set start and end date
        $startDate = "05-2010";
        $endDate = "03-2014";

        // build epoch datetimes from the start and end date
        $startEpochDatetime = $this->getEpochDatetimeFromFirstBrewedDateString(
            $startDate
        );
        $endEpochDatetime = $this->getEpochDatetimeFromFirstBrewedDateString(
            $endDate
        );

        $punkApi = new PunkAPI();

        // set the start and end date
        $punkApi->setBrewedAfter($startDate);
        $punkApi->setBrewedBefore($endDate);

        // get the beers
        $beers = $punkApi->all();
        // loop through the beers and check that the brew date for each beer
        // lies within the specified range
        foreach ($beers as $beer) {
            $currentBeerFirstBrewed = $beer->getFirstBrewed();
            // get the epoch datetime for current beer first brewed
            $currentBeerEpochDatetimeFirstBrewed = $this->getEpochDatetimeFromFirstBrewedDateString($currentBeerFirstBrewed);
            // test beer was brewed on or after start date
            $this->assertGreaterThanOrEqual(
                $startEpochDatetime,
                $currentBeerEpochDatetimeFirstBrewed,
                "Current beer should have been brewed on or after "
                . $startDate . ". Instead, it was brewed on "
                . $beer->getFirstBrewed()
            );
            // test beer was brewed before (or on) end date
            $this->assertLessThanOrEqual(
                $endEpochDatetime,
                $currentBeerEpochDatetimeFirstBrewed,
                "Current beer should have been brewed before (or on) "
                . $endDate . ". Instead, it was brewed on "
                . $beer->getFirstBrewed()
            );
        }
    }

    /**
     * From a first brewed date string in the form "04-2012" or "04/2012",
     * get an epoch datetime.
     *
     * @param string $firstBrewedDateString the date the beer was first
     *                                      brewed, in string form
     *                                      (MM/YYYY or MM-YYYY)
     *                                      (e.g. "05-2012" or "05/2012")
     *
     * @return int
     */
    private function getEpochDatetimeFromFirstBrewedDateString(
        $firstBrewedDateString
    ) {
        // convert date string in the form MM/YYYY to MM-YYYY
        $firstBrewedDateString = str_replace(
            '/',
            '-',
            $firstBrewedDateString
        );
        $dateObject = date_create_from_format(
            'm-Y',
            $firstBrewedDateString
        );
        $epochDatetime = date_timestamp_get($dateObject);

        return $epochDatetime;
    }

    /**
     * Test getting beers with a specific hop name.
     */
    public function testGettingBeersWithASpecificHopName()
    {
        $punkApi = new PunkApi;

        $punkApi->setHops("Simcoe");

        $beers = $punkApi->all();

        // loop through the beers and check that each beer contains the
        // specified hop
        foreach ($beers as $beer) {
            $hops = $beer->getIngredients()->getHops();
            $hopNameHasBeenFound = false;
            foreach ($hops as $hop) {
                if (strpos(strtoupper($hop->getName()), 'SIMCOE') !== false) {
                    $hopNameHasBeenFound = true;
                    break;
                }
            }
            $this->assertTrue(
                $hopNameHasBeenFound,
                "Hop name not found in beer.");
        }
    }

    /**
     * Test getting beers with a specific malt name.
     */
    public function testGettingBeersWithASpecificMaltName()
    {
        $punkApi = new PunkApi;
        $punkApi->setMalt("Munich");
        $beers = $punkApi->all();

        // loop through the beers and check that each beer contains the
        // specified malt
        foreach ($beers as $beer) {
            $malts = $beer->getIngredients()->getMalts();
            $maltNameHasBeenFound = false;
            foreach ($malts as $malt) {
                if (strpos(strtoupper($malt->getName()), 'MUNICH') !== false) {
                    $maltNameHasBeenFound = true;
                    break;
                }
            }
            $this->assertTrue(
                $maltNameHasBeenFound,
                "Malt name not found in beer.");
        }
    }

    /**
     * Method used to pause between API requests.
     *
     * @param int $totalSeconds the number of seconds to pause
     */
    private function pauseBetweenApiRequests($totalSeconds)
    {
        echo "\nPausing for " . $totalSeconds . " seconds to avoid contacting"
            . " the Punk API too rapidly...";
        sleep($totalSeconds);
        echo "done!\n";
    }


    /**
     * Check that the Beer information returned by the Punk API contains all
     * the correct keys.
     */
    public function testBeerInformationContainsAllCorrectKeys()
    {
        $punkApi = new PunkAPI;
        $beerInfo = $punkApi->singleAsArray(1);
        $beerInfoArrayKeys = array_keys($beerInfo);

        $arrayKeysToCheck = [
            'id',
            'name',
            'tagline',
            'first_brewed',
            'description',
            'image_url',
            'abv',
            'ibu',
            'target_fg',
            'target_og',
            'ebc',
            'srm',
            'ph',
            'attenuation_level',
            'volume',
            'boil_volume',
            'method',
            'ingredients',
            'food_pairing',
            'brewers_tips',
            'contributed_by'
        ];

        foreach ($beerInfoArrayKeys as $arrayKey) {
            $this->assertArrayHasKey(
                $arrayKey,
                $beerInfo,
                "The beer array returned by PunkAPI->singleAsArray()"
                . " doesn't contain the key " . $arrayKey
            );
        }
    }
}
